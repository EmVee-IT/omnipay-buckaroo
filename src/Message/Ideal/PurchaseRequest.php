<?php

namespace Omnipay\Buckaroo\Message\Ideal;

use Omnipay\Buckaroo\Message\TransactionRequest;

class PurchaseRequest extends TransactionRequest
{
    /**
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData()
    {
        $data = parent::getData();

        $parameters = [];

        if ($this->getIssuer()) {
            $data['ContinueOnIncomplete'] = false;
            $parameters[] = [
                "Name" => "issuer",
                "Value" => $this->getIssuer()
            ];
        } else {
            $data['ContinueOnIncomplete'] = true;
        }

        $data['Services']['ServiceList'] = [
            "Name" => "ideal",
            "Action" => "Pay",
            "parameters" => $parameters
        ];

        return $data;
    }
}