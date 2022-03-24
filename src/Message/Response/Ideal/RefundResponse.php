<?php

namespace Omnipay\Buckaroo\Message\Response\Ideal;

use Omnipay\Buckaroo\Message\Response\AbstractBuckarooResponse;

class RefundResponse extends AbstractBuckarooResponse
{
    public function getTransactionId()
    {
        return $this->data['Key'];
    }

    public function getTransactionReference()
    {
        return $this->data['RelatedTransactions']['RelatedTransactionKey'];
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