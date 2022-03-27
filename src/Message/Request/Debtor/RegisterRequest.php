<?php

namespace Omnipay\Buckaroo\Message\Request\Debtor;

use Omnipay\Buckaroo\Message\Request\DataRequest;
use Omnipay\Buckaroo\Message\Response\Debtor\RegisterResponse;
use Omnipay\Buckaroo\Traits\Debtor;

class RegisterRequest extends DataRequest implements DebtorInterface
{
    use Debtor;

    /**
     * @return array
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {

        $data = parent::getData();

        $parameters = [
            $this->getCode(),
            $this->getCulture(),
            $this->getFirstName(),
            $this->getLastName(),
            $this->getEmail(),
            $this->getStreet(),
            $this->getHouseNumber(),
            $this->getMobile(),
            $this->getLandline(),
            $this->getZipcode(),
            $this->getCity(),
            $this->getCountry(),
            $this->getBirthDate(),
            $this->getGender()
        ];

        return array_merge($data, [
            'Services' => [
                'ServiceList' => [
                    [
                        'Name' => 'CreditManagement3',
                        'Action' => 'AddOrUpdateDebtor',
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