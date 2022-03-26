<?php

namespace Omnipay\Buckaroo\Gateway;

class Debtor extends BuckarooGateway
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'Buckaroo Debtor';
    }

    public function register(array $options = array()): \Omnipay\Common\Message\RequestInterface
    {
        return $this->createRequest('\Omnipay\Buckaroo\Message\Request\Debtor\RegisterRequest', $options);
    }
}