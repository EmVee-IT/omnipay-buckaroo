<?php

namespace Omnipay\Buckaroo\Test\Gateway;

use Omnipay\Buckaroo\Gateway\BuckarooGateway;
use Omnipay\Common\GatewayInterface;
use Omnipay\Omnipay;
use Omnipay\Tests\GatewayTestCase;

class BuckarooGatewayTest extends GatewayTestCase
{
    /**
     * @var GatewayInterface
     */
    protected $gateway;

    protected function setUp(): void
    {
        $this->gateway = Omnipay::create(BuckarooGateway::class);
        $this->gateway->initialize([
            'websiteKey' => 'foo123',
            'secretKey' => 'bar456',
            'testMode' => true,
        ]);
    }

    public function testGetData()
    {
        $this->assertSame('foo123', $this->gateway->getWebsiteKey());
        $this->assertSame('bar456', $this->gateway->getSecretKey());
        $this->assertTrue($this->gateway->getTestMode());
    }

    /**
     * @test
     */
    public function testWebsiteKey()
    {
        $websiteKey = 'testKey';

        $this->gateway->setWebsiteKey($websiteKey);
        $this->assertEquals($websiteKey, $this->gateway->getWebsiteKey());
    }

    /**
     * @test
     */
    public function testSecretKey()
    {
        $secretKey = 'secretKey';

        $this->gateway->setSecretKey($secretKey);
        $this->assertEquals($secretKey, $this->gateway->getSecretKey());
    }
}
