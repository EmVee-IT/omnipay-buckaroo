<?php

namespace Omnipay\Buckaroo\Message\Request\Subscriptions;

use Omnipay\Buckaroo\Message\Request\DataRequest;
use Omnipay\Buckaroo\Message\Response\Debtor\RegisterResponse;
use Omnipay\Buckaroo\Traits\Subscriptions;
use Omnipay\Common\Exception\InvalidRequestException;

class CreateRequest extends DataRequest implements SubscriptionsInterface
{
    use Subscriptions;

    /**
     * @return array
     * @throws InvalidRequestException
     */
    public function getData(): array
    {
        $data = parent::getData();

        $parameters = [];
        foreach ($this->availableParameters as $parameterName => $parameter) {
            if (isset($parameter['required']) && $parameter['required']) {
                if (!$this->getParameter($parameterName)) {
                    $this->validate($parameterName);
                }
            }
            if ($value = $this->getParameter($parameterName)) {
                $parameters[] = $this->formatParameter($parameter, $value);
            }
        }

        return array_merge($data, [
            'Services' => [
                'ServiceList' => [
                    [
                        'Name' => 'Subscriptions',
                        'Action' => 'CreateSubscription',
                        'Parameters' => $parameters
                    ]
                ]
            ]
        ]);
    }

    public function sendData($data): RegisterResponse
    {
        $response =  parent::sendData($data);

        return $this->response = new RegisterResponse($this, $response);
    }
}