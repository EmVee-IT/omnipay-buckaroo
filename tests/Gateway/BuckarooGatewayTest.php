<?php

namespace Omnipay\Buckaroo\Test\Gateway;

use Omnipay\Buckaroo\Gateway\BuckarooGateway;
use Omnipay\Common\GatewayInterface;
use Omnipay\Omnipay;
use PHPUnit\Framework\TestCase;

class BuckarooGatewayTest extends TestCase
{
    /**
     * @var GatewayInterface
     */
    protected GatewayInterface $gateway;

    protected function setUp(): void
    {
        $this->gateway = Omnipay::create(BuckarooGateway::class);
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
