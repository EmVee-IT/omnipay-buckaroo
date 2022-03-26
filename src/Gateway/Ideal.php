<?php

namespace Omnipay\Buckaroo\Gateway;

class Ideal extends BuckarooGateway
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'Buckaroo iDeal';
    }

    /**
     * Return a list with possible Issuers
     * format: BIC => Name
     * @return string[]
     */
    public function getIssuers(): array
    {
        return [
            'ABNANL2A' => 'ABN AMRO',
            'ASNBNL21' => 'ASN Bank',
            'INGBNL2A' => 'ING',
            'RABONL2U' => 'Rabobank',
            'SNSBNL2A' => 'SNS Bank',
            'RBRBNL21' => 'SNS Regio Bank',
            'TRIONL2U' => 'Triodos Bank',
            'FVLBNL22' => 'Van Lanschot',
            'KNABNL2H' => 'Knab',
            'BUNQNL2A' => 'Bunq',
            'HANDNL2A' => 'Handelsbanken',
            'REVOLT21' => 'Revolut'
        ];
    }

    public function purchase(array $options = array()): \Omnipay\Common\Message\RequestInterface
    {
        return $this->createRequest('\Omnipay\Buckaroo\Message\Request\Ideal\PurchaseRequest', $options);
    }

    public function refund(array $options = array()): \Omnipay\Common\Message\RequestInterface
    {
        return $this->createRequest('\Omnipay\Buckaroo\Message\Request\Ideal\RefundRequest', $options);
    }
}