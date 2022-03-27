<?php

namespace Omnipay\Buckaroo\Test\Message;

use Omnipay\Buckaroo\Message\Request\Ideal\PurchaseRequest;
use Omnipay\Buckaroo\Message\Response\Ideal\PurchaseResponse;
use Omnipay\Tests\TestCase;

class IdealPurchaseTest extends TestCase
{
    /**
     * @var PurchaseRequest
     */
    private PurchaseRequest $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize([
            'websiteKey' => 'foo123',
            'secretKey' => 'bar456',
            'testMode' => true,
            'currency' => 'EUR',
            'amount' => '10.00',
            'description' => 'Ideal_Test_1647014471'
        ]);
    }

    public function testGetData()
    {
        $this->assertTrue($this->request->getTestMode());
        $this->assertSame('foo123', $this->request->getWebsiteKey());
        $this->assertSame('bar456', $this->request->getSecretKey());

        $data = $this->request->getData();

        $this->assertSame('10.00', $data['AmountDebit']);
        $this->assertSame('EUR', $data['Currency']);
        $this->assertSame('Ideal_Test_1647014471', $data['Invoice']);
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('ideal_purchase_pending_response.txt');
        $response = $this->request->send();

        $this->assertInstanceOf(PurchaseResponse::class, $response);
        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isPending());
        $this->assertFalse($response->isCancelled());
        $this->assertSame('Ideal_Test_1648289452', $response->getTransactionReference());
        $this->assertNotNull($response->getRedirectUrl());
        $this->assertNull($response->getCode());
    }
}