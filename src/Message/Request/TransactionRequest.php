<?php

namespace Omnipay\Buckaroo\Message\Request;

use Omnipay\Common\Message\ResponseInterface;

class TransactionRequest extends AbstractBuckarooRequest
{

    public function getData()
    {
        $data = [
            'Currency' => $this->getCurrency(),
            'Invoice' => $this->getDescription(),
            'Services' => [
                'ServiceList' => []
            ]
        ];

        return $data;
    }

    public function sendData($data)
    {
        return $this->sendRequest(
            self::POST,
            $data,
            'Transaction'
        );
    }
}