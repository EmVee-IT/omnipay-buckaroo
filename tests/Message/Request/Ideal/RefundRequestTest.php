<?php

namespace Omnipay\Buckaroo\Test\Message\Request\Ideal;

use Omnipay\Buckaroo\Message\Request\Ideal\RefundRequest;
use Omnipay\Common\Http\Client as HttpClient;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

class RefundRequestTest extends TestCase
{
    /**
     * @var RefundRequest $testedClass
     */
    protected RefundRequest $testedClass;

    protected function setUp(): void
    {
        $httpClient = new HttpClient();
        $httpRequest = HttpRequest::createFromGlobals();

        $class = new class($httpClient, $httpRequest) extends RefundRequest{};

        $class->setWebsiteKey('WglTrRZsVG');
        $class->setSecretKey('pKtbrbgnW3GsEid337ifBzZjJbv2zscv');
        $class->setCurrency('EUR');
        $class->setAmount('10.00');
        $class->setDescription('Ideal_Test_1647014471');
        $class->setTransactionId('12CB3D2D84C748BF966685000BE050F3');

        $this->testedClass = $class;
    }

    public function testGetData()
    {
        $data = $this->testedClass->getData();

        $this->assertIsArray($data);

        $this->assertArrayHasKey('Currency', $data);
        $this->assertEquals('EUR', $data['Currency']);

        $this->assertArrayHasKey('AmountCredit', $data);
        $this->assertEquals('10.00', $data['AmountCredit']);

        $this->assertArrayHasKey('Invoice', $data);
        $this->assertEquals('Ideal_Test_1647014471', $data['Invoice']);

        $this->assertArrayHasKey('Services', $data);
        $this->assertArrayHasKey('ServiceList', $data['Services']);
        $this->assertEquals('ideal', $data['Services']['ServiceList'][0]['Name']);
        $this->assertEquals('Refund', $data['Services']['ServiceList'][0]['Action']);
    }

}
