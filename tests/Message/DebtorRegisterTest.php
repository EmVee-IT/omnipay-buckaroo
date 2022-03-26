<?php

namespace Omnipay\Buckaroo\Test\Message;

use Omnipay\Buckaroo\Message\Request\Debtor\RegisterRequest;
use Omnipay\Tests\TestCase;

class DebtorRegisterTest extends TestCase
{
    /**
     * @var RegisterRequest
     */
    private RegisterRequest $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new RegisterRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize([
            'websiteKey' => 'foo123',
            'secretKey' => 'bar456',
            'testMode' => true,
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
        ]);
    }

    public function testGetData()
    {
        $this->assertTrue($this->request->getTestMode());
        $this->assertSame('foo123', $this->request->getWebsiteKey());
        $this->assertSame('bar456', $this->request->getSecretKey());

        $this->assertSame('John', $this->request->getFirstName()['Value']);
    }
}