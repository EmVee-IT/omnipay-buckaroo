<?php

namespace Omnipay\Buckaroo\Message\Request;

class DataRequest extends AbstractBuckarooRequest
{

    public function getData()
    {
        return [
            'Services' => [
                'ServiceList' => []
            ]
        ];
    }

    public function sendData($data)
    {
        return $this->sendRequest(
            self::POST,
            $data,
            'DataRequest'
        );
    }
}