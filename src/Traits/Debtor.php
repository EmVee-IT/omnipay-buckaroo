<?php

namespace Omnipay\Buckaroo\Traits;

use Brick\PhoneNumber\PhoneNumberParseException;
use libphonenumber\PhoneNumberFormat;
use Omnipay\Buckaroo\Message\Request\Debtor\DebtorInterface;
use Brick\PhoneNumber\PhoneNumber;

/**
 * @method getParameter($parameter)
 * @method setParameter($parameters, $value)
 */
trait Debtor
{
    /**
     * @return array
     */
    public function getLastName(): array
    {
        return [
            'Name' => 'LastName',
            'GroupType' => 'Person',
            'GroupID' => '',
            'Value' => $this->getParameter('lastName')
        ];
    }

    /**
     * @param string $value
     * @return DebtorInterface
     */
    public function setLastName(string $value): DebtorInterface
    {
        return $this->setParameter('lastName', $value);
    }

    /**
     * @return array
     */
    public function getFirstName(): array
    {
        return [
            'Name' => 'FirstName',
            'GroupType' => 'Person',
            'GroupID' => '',
            'Value' => $this->getParameter('firstName')
        ];
    }

    /**
     * @param string $value
     * @return DebtorInterface
     */
    public function setFirstName(string $value): DebtorInterface
    {
        return $this->setParameter('firstName', $value);
    }

    /**
     * @return array
     */
    public function getCulture(): array
    {
        return [
            'Name' => 'Culture',
            'GroupType' => 'Person',
            'GroupID' => '',
            'Value' => $this->getParameter('culture')
        ];
    }

    /**
     * @param string $value
     * @return DebtorInterface
     */
    public function setCulture(string $value): DebtorInterface
    {
        return $this->setParameter('culture', $value);
    }

    /**
     * @return array
     */
    public function getCode(): array
    {
        return [
            'Name' => 'Code',
            'GroupType' => 'Debtor',
            'GroupID' => '',
            'Value' => ($this->getParameter('code')?:
                $this->getParameter('firstName') .
                $this->getParameter('lastName') .
                rand(00,99))
        ];
    }

    /**
     * @param string $value
     * @return DebtorInterface
     */
    public function setCode(string $value): DebtorInterface
    {
        return $this->setParameter('code', $value);
    }

    /**
     * @return array
     */
    public function getEmail(): array
    {
        return [
            'Name' => 'Email',
            'GroupType' => 'Email',
            'GroupID' => '',
            'Value' => $this->getParameter('email')
        ];
    }

    /**
     * @param string $value
     * @return DebtorInterface
     */
    public function setEmail(string $value): DebtorInterface
    {
        return $this->setParameter('email', $value);
    }

    /**
     * @return array
     */
    public function getBirthDate(): array
    {
        return [
            'Name' => 'BirthDate',
            'GroupType' => 'Person',
            'GroupID' => '',
            'Value' => $this->getParameter('birthDate')
        ];
    }

    /**
     * @param string $value
     * @return DebtorInterface
     */
    public function setBirthDate(string $value): DebtorInterface
    {
        return $this->setParameter('birthDate', $value);
    }

    /**
     * @return array
     */
    public function getGender(): array
    {
        return [
            'Name' => 'Gender',
            'GroupType' => 'Person',
            'GroupID' => '',
            'Value' => $this->getParameter('gender')
        ];
    }

    /**
     * @param string $value
     * @return DebtorInterface
     */
    public function setGender(string $value): DebtorInterface
    {
        return $this->setParameter('gender', $value);
    }

    /**
     * @return array
     */
    public function getStreet(): array
    {
        return [
            'Name' => 'Street',
            'GroupType' => 'Address',
            'GroupID' => '',
            'Value' => $this->getParameter('street')
        ];
    }

    /**
     * @param string $value
     * @return DebtorInterface
     */
    public function setStreet(string $value): DebtorInterface
    {
        return $this->setParameter('street', $value);
    }

    /**
     * @return array
     */
    public function getHouseNumber(): array
    {
        return [
            'Name' => 'HouseNumber',
            'GroupType' => 'Address',
            'GroupID' => '',
            'Value' => $this->getParameter('houseNumber')
        ];
    }

    /**
     * @param string $value
     * @return DebtorInterface
     */
    public function setHouseNumber(string $value): DebtorInterface
    {
        return $this->setParameter('houseNumber', $value);
    }

    /**
     * @return array
     */
    public function getZipcode(): array
    {
        return [
            'Name' => 'Zipcode',
            'GroupType' => 'Address',
            'GroupID' => '',
            'Value' => $this->getParameter('zipcode')
        ];
    }

    /**
     * @param string $value
     * @return DebtorInterface
     */
    public function setZipcode(string $value): DebtorInterface
    {
        return $this->setParameter('zipcode', $value);
    }

    /**
     * @return array
     */
    public function getCity(): array
    {
        return [
            'Name' => 'City',
            'GroupType' => 'Address',
            'GroupID' => '',
            'Value' => $this->getParameter('city')
        ];
    }

    /**
     * @param string $value
     * @return DebtorInterface
     */
    public function setCity(string $value): DebtorInterface
    {
        return $this->setParameter('city', $value);
    }

    /**
     * @return array
     */
    public function getCountry(): array
    {
        return [
            'Name' => 'Country',
            'GroupType' => 'Address',
            'GroupID' => '',
            'Value' => $this->getParameter('country')
        ];
    }

    /**
     * @param string $value
     * @return DebtorInterface
     */
    public function setCountry(string $value): DebtorInterface
    {
        return $this->setParameter('country', $value);
    }

    /**
     * @return array
     */
    public function getMobile(): array
    {
        return [
            'Name' => 'Mobile',
            'GroupType' => 'Phone',
            'GroupID' => '',
            'Value' => $this->getParameter('mobile')
        ];
    }

    /**
     * @param string $value
     * @param null $countryCode
     * @return DebtorInterface
     * @throws \Exception
     */
    public function setMobile(string $value, $countryCode = null): DebtorInterface
    {
        if ($countryCode == null && !$this->getParameter('country')) {
            throw new \Exception('No country set');
        }

        $countryCode = $countryCode?: $this->getParameter('country');

        $number = PhoneNumber::parse($value, $countryCode);
        if (!$number->isValidNumber()) {
            throw new \Exception('Invalid phonenumber');
        }

        return $this->setParameter('mobile', $number->format(PhoneNumberFormat::E164));
    }

    /**
     * @return array
     */
    public function getLandline(): array
    {
        return [
            'Name' => 'Landline',
            'GroupType' => 'Phone',
            'GroupID' => '',
            'Value' => $this->getParameter('landline')
        ];
    }

    /**
     * @param string $value
     * @param null $countryCode
     * @return DebtorInterface
     * @throws \Exception
     */
    public function setLandline(string $value, $countryCode = null): DebtorInterface
    {
        if ($countryCode == null && !$this->getParameter('country')) {
            throw new \Exception('No country set');
        }

        $countryCode = $countryCode?: $this->getParameter('country');

        try {
            $number = PhoneNumber::parse($value, $countryCode);
        } catch (PhoneNumberParseException $e) {
            throw new \Exception('Invalid phonenumber');
        }

        return $this->setParameter('landline', $number->format(PhoneNumberFormat::E164));
    }
}