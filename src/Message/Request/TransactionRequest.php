<?php

namespace Omnipay\Buckaroo\Message\Request;

use Omnipay\Common\Message\ResponseInterface;

class TransactionRequest extends AbstractBuckarooRequest
{

    public function getData()
    {
        // TODO: Implement getData() method.
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