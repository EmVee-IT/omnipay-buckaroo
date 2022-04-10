<?php

namespace Omnipay\Buckaroo\Test\Gateway;

use Omnipay\Buckaroo\Gateway\Subscriptions;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Tests\GatewayTestCase;

class SubscriptionsTest extends GatewayTestCase
{
    protected $gateway;

    protected function setUp(): void
    {
        $this->gateway = new Subscriptions($this->getHttpClient(), $this->getHttpRequest());

        $this->gateway->initialize([
            'websiteKey' => 'foo123',
            'secretKey' => 'bar456',
            'testMode' => true,
        ]);
    }

    public function testCreateSucceeds()
    {
        $this->setMockHttpResponse('subscriptions_create_success_response.txt');

        $response = $this->gateway->register([
            'configurationCode' => 'foo123',
            'ratePlanCode' => '123ase1',
            'startDate' => '23-12-2022',
            'debtorCode' => 'FirstName22'
        ])->send();

        $this->assertTrue($response->isSuccessful());
    }

    public function testCreateFails()
    {
        $this->expectException(InvalidRequestException::class);

        $this->gateway->register()->send();
    }
}