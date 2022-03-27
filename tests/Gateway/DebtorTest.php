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

    public function testRegisterSucceeds()
    {
        $this->setMockHttpResponse('debtor_register_success_response.txt');

        $response = $this->gateway->register([
            'firstName' => 'John',
            'lastName' => 'Doe',
            'code' => 'JohnDoe12',
            'gender' => 1,
            'culture' => 'nl-NL',
            'email' => 'john.doe@example.com',
            'street' => 'fakersstreet',
            'birthDate' => '01-01-2001',
            'houseNumber' => 1,
            'zipcode' => '1234AA',
            'country' => 'NL',
            'mobile' => '+31612345678',
            'landline' => '+31206241111',
            'city' => 'Fakersville',
        ])->send();

        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isRedirect());
        $this->assertTrue($response->isSuccessful());
    }

    public function testRegisterWithoutCodeSucceeds()
    {
        $this->setMockHttpResponse('debtor_register_success_response.txt');

        $response = $this->gateway->register([
            'firstName' => 'John',
            'lastName' => 'Doe',
            'gender' => 1,
            'culture' => 'nl-NL',
            'email' => 'john.doe@example.com',
            'street' => 'fakersstreet',
            'birthDate' => '01-01-2001',
            'houseNumber' => 1,
            'zipcode' => '1234AA',
            'country' => 'NL',
            'mobile' => '+31612345678',
            'landline' => '+31206241111',
            'city' => 'Fakersville',
        ])->send();

        $this->assertFalse($response->isCancelled());
        $this->assertFalse($response->isRedirect());
        $this->assertTrue($response->isSuccessful());
    }

    public function testRegisterMobileWithoutCountryFails()
    {
        $this->expectException(\Exception::class);
        $response = $this->gateway->register([
            'mobile' => '+31612345678',
        ])->send();
    }

    public function testRegisterLandlineWithoutCountryFails()
    {
        $this->expectException(\Exception::class);
        $response = $this->gateway->register([
            'landline' => '+31206241111',
        ])->send();
    }

    public function testRegisterWithoutInvalidMobileFails()
    {

        $this->expectException(\Exception::class);

        $response = $this->gateway->register([
            'country' => 'NL',
            'mobile' => '999',
        ])->send();
    }

    public function testRegisterWithoutInvalidLandlineFails()
    {

        $this->expectException(\Exception::class);

        $response = $this->gateway->register([
            'country' => 'NL',
            'landline' => '888',
        ])->send();
    }
}