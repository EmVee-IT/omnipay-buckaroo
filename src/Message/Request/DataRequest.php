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

    /**
     * @param $parameter
     * @param $value
     * @return array
     */
    protected function formatParameter($parameter, $value): array
    {
        $data  = [
            'Name' => $parameter['name'],
            'Value' => $value
        ];

        if (!is_null($parameter['group'])) {
            $data['GroupType'] = $parameter['group'];
            $data['GroupID'] = '';
        }

        return $data;
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