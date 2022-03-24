<?php

namespace Omnipay\Buckaroo\Message\Request;

use Omnipay\Common\Message\AbstractRequest;

abstract class AbstractBuckarooRequest extends AbstractRequest
{
    const POST = 'POST';
    const GET = 'GET';
    const DELETE = 'DELETE';

    const ENDPOINT_TEST = 'testcheckout.buckaroo.nl/json/';
    const ENDPOINT_LIVE = 'checkout.buckaroo.nl/json/';

    /**
     * @return string
     */
    public function getSecretKey(): string
    {
        return $this->getParameter('secretKey');
    }

    /**
     * @param string $value
     * @return AbstractBuckarooRequest
     */
    public function setSecretKey(string $value): AbstractBuckarooRequest
    {
        return $this->setParameter('secretKey', $value);
    }

    /**
     * @return string
     */
    public function getWebsiteKey(): string
    {
        return $this->getParameter('websiteKey');
    }

    /**
     * @param string $value
     * @return AbstractBuckarooRequest
     */
    public function setWebsiteKey(string $value): AbstractBuckarooRequest
    {
        return $this->setParameter('websiteKey', $value);
    }

    /**
     * @param $method
     * @param array|null $data
     * @return void
     */
    protected function sendRequest($method, array $data)
    {
        $url = ($this->getTestMode()? self::ENDPOINT_TEST : self::ENDPOINT_LIVE);
        $url .= 'Transaction';

        $data = json_encode($data);
        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => $this->getAuthHeader($url, $data, $method)
        ];

        $response = $this->httpClient->request(
            $method,
            "https://{$url}",
            $headers,
            $data
        );

        return json_decode($response->getBody(), true);
    }

    public function getEncodedContent($content)
    {
        if ($content) {
            $md5 = md5($content, true);
            $base64 = base64_encode($md5);
            $content = $base64;
        }

        return $content;
    }

    /**
     * @param $method
     * @param $nonce
     * @param $timestamp
     * @param $url
     * @param $content
     * @return string
     */
    public function getHash($method, $nonce, $timestamp, $url, $content): string
    {
        $encodedContent = $this->getEncodedContent($content);

        $rawData = $this->getWebsiteKey() . $method . $url . $timestamp . $nonce . $encodedContent;
        $hash = hash_hmac("sha256", $rawData, $this->getSecretKey(), true);
        return base64_encode($hash);
    }

    /**
     * @return string
     */
    public function getNonce(): string
    {
        $text = '';
        $possible = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        for($i=0; $i<16; $i++) {
            $text .= $possible[rand(0, strlen($possible) - 1)];
        }

        return $text;
    }

    /**
     * @param $url
     * @param $content
     * @param $method
     * @return int|string
     */
    protected function  getAuthHeader($url, $content, $method): int|string
    {
        $nonce = $this->getNonce();
        $timestamp = time();
        $content = $content?: '';
        $url = strtolower(urlencode($url));
        $hash = $this->getHash(
            $method,
            $nonce,
            $timestamp,
            $url,
            $content
        );

        return 'hmac ' . $this->getWebsiteKey() . ':' . $hash . ':' . $nonce . ':' . $timestamp;
    }
}