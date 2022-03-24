<?php

namespace Omnipay\Buckaroo\Message\Request\Ideal;

use Omnipay\Buckaroo\Message\Request\TransactionRequest;
use Omnipay\Buckaroo\Message\Response\Ideal\RefundResponse;

class RefundRequest extends TransactionRequest
{
    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        return [
            'Currency' => $this->getCurrency(),
            'AmountCredit' => $this->getAmount(),
            'Invoice' => $this->getDescription(),
            'OriginalTransactionKey' => $this->getTransactionId(),
            'Services' => [
                    'ServiceList' => [
                        [
                            'Name' => 'ideal',
                            'Action' => 'Refund'
                        ]
                    ]
                ]
        ];
    }

    public function sendData($data): RefundResponse
    {
        $response =  parent::sendData($data);

        return $this->response = new RefundResponse($this, $response);
    }
}