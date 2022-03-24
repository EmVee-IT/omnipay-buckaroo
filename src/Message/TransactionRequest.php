<?php

namespace Omnipay\Buckaroo\Message;

use Omnipay\Common\Message\ResponseInterface;

class TransactionRequest extends AbstractRequest
{

    /**
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $data = parent::getData();

        $data['Invoice'] = $this->getTransactionId();
        $data['Description'] = $this->getDescription();
        $data['Currency'] = $this->getCurrency();
        $data['AmountDebit'] = $this->getAmount();

        return $data;

    }

    public function sendData($data)
    {
        return $this->response = new TransactionResponse($this, $data);
    }
}