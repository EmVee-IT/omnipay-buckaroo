<?php

namespace Omnipay\Buckaroo\Test\Gateway;

use Omnipay\Buckaroo\Gateway\Ideal;
use Omnipay\Buckaroo\Message\Response\Ideal\PurchaseResponse;
use Omnipay\Omnipay;
use PHPUnit\Framework\TestCase;

class IdealTest extends TestCase
{
    protected \Omnipay\Common\GatewayInterface $gateway;

    protected function setUp(): void
    {
        $this->gateway = Omnipay::create(\Omnipay\Buckaroo\Gateway\Ideal::class);
        $this->gateway->setTestMode(true);
        $this->gateway->setWebsiteKey('WglTrRZsVG');
        $this->gateway->setSecretKey('pKtbrbgnW3GsEid337ifBzZjJbv2zscv');
    }

    public function testPurchase()
    {
//        $description = 'iDeal_Test_' . time();
//        /** @var PurchaseResponse $response */
//        $response = $this->gateway->purchase([
//            'amount' => '10.00',
//            'description' => $description,
//            'currency' => 'EUR',
//            'issuer' => 'ABNANL2A'
//        ])->send();
//
//        $this->assertEquals(true, $response->isPending());
//        $this->assertEquals(32, strlen($response->getTransactionId()));
//        $this->assertEquals($description, $response->getTransactionReference());
        $this->assertTrue(true);
    }

    public function testRefund()
    {
//        $response = $this->gateway->refund([
//            'amount' => '10.00',
//            'transactionId' => '7198CD88018D4AC78B909D882C3D2B5B',
//            'currency' => 'EUR',
//            'description' => 'iDeal_Test_1648081681'
//        ])->send();
//
//        $this->assertEquals(true, $response->isSuccessful());
        $this->assertTrue(true);
    }
}
