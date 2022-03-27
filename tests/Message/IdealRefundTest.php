<?php

namespace Omnipay\Buckaroo\Test\Message;

use Omnipay\Buckaroo\Message\Request\Ideal\RefundRequest;
use Omnipay\Buckaroo\Message\Response\Ideal\PurchaseResponse;
use Omnipay\Buckaroo\Message\Response\Ideal\RefundResponse;
use Omnipay\Tests\TestCase;

class IdealRefundTest extends TestCase
{
    /**
     * @var RefundRequest
     */
    private RefundRequest $request;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new RefundRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize([
            'websiteKey' => 'foo123',
            'secretKey' => 'bar456',
            'testMode' => true,
            'amount' => '0.01',
            'transactionId' => '3C9C00766C584523AC04A9523F946523',
            'currency' => 'EUR',
            'description' => 'Ideal_Test_1648289452'
        ]);
    }

    public function testGetData()
    {
        $this->assertTrue($this->request->getTestMode());
        $this->assertSame('foo123', $this->request->getWebsiteKey());
        $this->assertSame('bar456', $this->request->getSecretKey());

        $data = $this->request->getData();

        $this->assertSame('0.01', $data['AmountCredit']);
        $this->assertSame('EUR', $data['Currency']);
        $this->assertSame('Ideal_Test_1648289452', $data['Invoice']);
    }

    public function testSendSuccess()
    {
        $this->setMockHttpResponse('ideal_refund_success_response.txt');

        $response = $this->request->send();

        $this->assertInstanceOf(RefundResponse::class, $response);
        $this->assertTrue($response->isSuccessful());
        $this->assertSame('FF1EB73EADC34B079BF1A525FA657D41', $response->getTransactionId());
        $this->assertSame('3C9C00766C584523AC04A9523F946523', $response->getTransactionReference());
        $this->assertSame('Transaction successfully processed', $response->getMessage());
        $this->assertSame('S001', $response->getCode());
    }
}