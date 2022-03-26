<?php

namespace Omnipay\Buckaroo\Test\Gateway;

use Omnipay\Buckaroo\Gateway\Debtor;
use Omnipay\Tests\GatewayTestCase;

class DebtorTest extends GatewayTestCase
{
    protected $gateway;

    protected function setUp(): void
    {
        $this->gateway = new Debtor($this->getHttpClient(), $this->getHttpRequest());

        $this->gateway->initialize([
            'websiteKey' => 'foo123',
            'secretKey' => 'bar456',
            'testMode' => true,
        ]);
    }

    public function testRegister()
    {
        $this->setMockHttpResponse('debtor_register_success_response.txt');

        $response = $this->gateway->register([
            'firstName' => 'John',
            'lastName' => 'Doe',
            'culture' => 'nl-NL',
            'email' => 'john.doe@example.com',
            'street' => 'fakersstreet',
            'houseNumber' => 1,
            'zipcode' => '1234AA',
            'country' => 'NL',
            'mobile' => '+31612345678',
            'city' => 'Fakersville',
        ])->send();

        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isRedirect());
        $this->assertTrue($response->isSuccessful());
    }
}