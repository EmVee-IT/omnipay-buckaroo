<?php

namespace Omnipay\Buckaroo\Message\Response\Subscriptions;

use Omnipay\Buckaroo\Message\Response\AbstractBuckarooResponse;

class CreateResponse extends AbstractBuckarooResponse
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