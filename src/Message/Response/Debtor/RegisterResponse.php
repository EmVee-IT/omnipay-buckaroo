<?php

namespace Omnipay\Buckaroo\Message\Response\Debtor;

use Omnipay\Buckaroo\Message\Response\AbstractBuckarooResponse;

class RegisterResponse extends AbstractBuckarooResponse
{
    public function getTransactionId()
    {
        return $this->data['Key'];
    }

    public function getCode()
    {
        return $this->data['Status']['SubCode']['Code'];
    }

    public function getMessage()
    {
        return $this->data['Status']['SubCode']['Description'];
    }
}
