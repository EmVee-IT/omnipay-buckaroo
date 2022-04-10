<?php

namespace Omnipay\Buckaroo\Gateway;

class Subscriptions extends BuckarooGateway
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'Buckaroo Subscriptions';
    }

    public function register(array $options = array()): \Omnipay\Common\Message\RequestInterface
    {
        return $this->createRequest('\Omnipay\Buckaroo\Message\Request\Subscriptions\CreateRequest', $options);
    }
}