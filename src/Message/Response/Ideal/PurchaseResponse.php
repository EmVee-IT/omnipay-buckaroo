<?php

namespace Omnipay\Buckaroo\Message\Response\Ideal;

use Omnipay\Buckaroo\Message\Response\AbstractBuckarooResponse;

class PurchaseResponse extends AbstractBuckarooResponse
{
    public function getTransactionId()
    {
        return $this->data['Key'];
    }

    public function getTransactionReference()
    {
        return $this->data['Invoice'];
    }

    public function getCode()
    {
        if ($this->data['Status']['SubCode'] == null) {
            return null;
        }
        return $this->data['Status']['SubCode']['Code'];
    }

    public function getMessage()
    {
        if ($this->data['Status']['SubCode'] == null) {
            return null;
        }
        return $this->data['Status']['SubCode']['Description'];
    }

    public function getRedirectUrl()
    {
        return $this->data['RequiredAction']['RedirectURL'];
    }
}