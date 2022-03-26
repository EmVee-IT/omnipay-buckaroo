<?php

namespace Omnipay\Buckaroo\Message\Request\Ideal;

use Omnipay\Buckaroo\Message\Request\TransactionRequest;
use Omnipay\Buckaroo\Message\Response\Ideal\PurchaseResponse;

class PurchaseRequest extends TransactionRequest
{
    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $data = parent::getData();

        $data = array_merge($data, [
            'AmountDebit' => $this->getAmount(),
            'Services' => [ 'ServiceList' => [
                    [
                        'Name' => 'ideal',
                        'Action' => 'Pay'
                    ]
            ]]
        ]);

        if ($this->getIssuer()) {
            $data['Services']['ServiceList'][0]['Parameters'] = [
                [
                    "Name" => "issuer",
                    "Value" => $this->getIssuer()
                ]
            ];
        }

        return $data;
    }

    public function sendData($data): PurchaseResponse
    {
        $response =  parent::sendData($data);

        return $this->response = new PurchaseResponse($this, $response);
    }
}