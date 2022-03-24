<?php

namespace Omnipay\Buckaroo\Test\Message\Request;

use Omnipay\Buckaroo\Message\Request\AbstractBuckarooRequest;
use Omnipay\Common\Message\ResponseInterface;
use PHPUnit\Framework\TestCase;
use Omnipay\Common\Http\Client as HttpClient;
use Symfony\Component\HttpFoundation\Request as HttpRequest;
class AbstractBuckarooRequestTest extends TestCase
{
    protected function setUp(): void
    {
        $httpClient = new HttpClient();
        $httpRequest = HttpRequest::createFromGlobals();

        $class = new class($httpClient, $httpRequest) extends AbstractBuckarooRequest {
            public function getData()
            {
                // TODO: Implement getData() method.
            }

            public function sendData($data)
            {
                // TODO: Implement sendData() method.
            }
        };

        $class->setWebsiteKey('123123');
        $class->setSecretKey('dsf9s034klsd');

        $this->testedClass = $class;
    }

    /** @test */
    public function testGetNonce()
    {
        $this->assertEquals(16, strlen($this->testedClass->getNonce()));
    }

    public function encodedProvider(): array
    {
        return [
            [
                'X1Lv2SNWageGf6eTgtuJFw==',
                [
                    "Currency" => "EUR",
                    "AmountDebit" => 10.00,
                    "Invoice" => "testinvoice 123",
                    "Services" => [
                        "ServiceList" => [
                            [
                                "Action" => "Pay",
                                "Name" => "ideal",
                                "Parameters" => [
                                    [
                                        "Name" => "issuer",
                                        "Value" => "ABNANL2A"
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * @dataProvider encodedProvider
     */
    public function testGetEncodedContent($expected, $content)
    {
        $content = json_encode($content);
        $this->assertEquals($expected, $this->testedClass->getEncodedContent($content));
    }

    public function hashProvider(): array
    {
        $date = new \DateTime('2022-01-01 10:00:00');
        $timestamp = $date->getTimestamp();
        return [
            [
                'SwnMtaQGgSEPscHOE1U6o8qcI/PFkkzmF2QouoJH/tQ=',
                'POST',
                'asdf1234JKDROI43',
                $timestamp,
                AbstractBuckarooRequest::ENDPOINT_TEST,
                [
                    "Currency" => "EUR",
                    "AmountDebit" => 10.00,
                    "Invoice" => "testinvoice 123",
                    "Services" => [
                        "ServiceList" => [
                            [
                                "Action" => "Pay",
                                "Name" => "ideal",
                                "Parameters" => [
                                    [
                                        "Name" => "issuer",
                                        "Value" => "ABNANL2A"
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    /** @dataProvider hashProvider */
    public function testGetHash($expected, $method, $nonce, $timestamp, $url, $content)
    {
        $content = json_encode($content);
        $this->assertEquals($expected, $this->testedClass->getHash($method, $nonce, $timestamp, $url, $content));
    }
}
