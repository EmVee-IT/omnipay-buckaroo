<?php


namespace Omnipay\Buckaroo\Test\Gateway;

use Omnipay\Buckaroo\Gateway\Ideal;
use Omnipay\Buckaroo\Test\Gateway\PurchaseResponse;
use Omnipay\Common\GatewayInterface;
use Omnipay\Tests\GatewayTestCase;

class IdealTest extends GatewayTestCase
{
    /**
     * @var GatewayInterface
     */
    protected $gateway;

    protected function setUp(): void
    {
        $this->gateway = new Ideal($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->initialize([
            'websiteKey' => 'foo123',
            'secretKey' => 'bar456',
            'testMode' => true,
        ]);
    }

    public function testGetIssuers()
    {
        $this->assertArrayHasKey('KNABNL2H', $this->gateway->getIssuers());
        $this->assertArrayHasKey('SNSBNL2A', $this->gateway->getIssuers());
    }

    public function testPurchase()
    {
        $this->setMockHttpResponse('ideal_purchase_pending_response.txt');
        /** @var PurchaseResponse $response */
        $response = $this->gateway->purchase([
            'amount' => '10.00',
            'description' => 'Ideal_Test_1648289452',
            'currency' => 'EUR',
            'issuer' => 'ABNANL2A'
        ])->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isPending());
        $this->assertFalse($response->isCancelled());
        $this->assertNotNull($response->getRedirectUrl());

        $this->assertEquals(32, strlen($response->getTransactionId()));
    }

    public function testRefundSuccess()
    {
        $this->setMockHttpResponse('ideal_refund_success_response.txt');

        $response = $this->gateway->refund([
            'amount' => '0.01',
            'transactionId' => '3C9C00766C584523AC04A9523F946523',
            'currency' => 'EUR',
            'description' => 'Ideal_Test_1648289452'
        ])->send();

        $this->assertTrue($response->isSuccessful());
    }
}
