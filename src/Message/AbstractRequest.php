<?php

namespace Omnipay\Buckaroo\Message;

/**
 * Buckaroo Abstract Request
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $testEndpoint = 'https://testcheckout.buckaroo.nl/json/';
    protected $liveEndpoint = 'https://checkout.buckaroo.nl/json/';

    public function getWebsiteKey()
    {
        return $this->getParameter('websiteKey');
    }

    public function setWebsiteKey($value)
    {
        return $this->setParameter('websiteKey', $value);
    }

    public function getSecretKey()
    {
        return $this->getParameter('secretKey');
    }

    public function setSecretKey($value)
    {
        return $this->setParameter('secretKey', $value);
    }

    public function getData()
    {
        $data = [];
        $data['Currency'] = $this->getCurrency();
        $data['AmountDebit'] = $this->getAmount();
        $data['Invoice'] = $this->getTransactionId();

        return $data;
    }


}