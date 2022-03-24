<?php namespace Omnipay\Buckaroo\Gateway;

use Omnipay\Common\AbstractGateway as CommonAbstractGateway;

abstract class AbstractGateway extends CommonAbstractGateway
{
    const ENDPOINT_LIVE = 'https://checkout.buckaroo.nl/json';
    const ENDPOINT_TEST = 'https://testcheckout.buckaroo.nl/json';

    /**
     * @return array
     */
    public function getDefaultParameters(): array
    {
        return [
            'websiteKey' => null,
            'secretKey' => null,
            'testMode' => false
        ];
    }

    /**
     * @return string
     */
    public function getSecretKey(): string
    {
        return $this->getParameter('secretKey');
    }

    /**
     * @param string $secretKey
     * @return AbstractGateway
     */
    public function setSecretKey(string $secretKey): AbstractGateway
    {
        return $this->setParameter('secretKey', $secretKey);
    }

    /**
     * @return string
     */
    public function getWebsiteKey(): string
    {
        return $this->getParameter('websiteKey');
    }

    /**
     * @param string $websiteKey
     * @return AbstractGateway
     */
    public function setWebsiteKey(string $websiteKey): AbstractGateway
    {
        return $this->setParameter('websiteKey', $websiteKey);
    }
}