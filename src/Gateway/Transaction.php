<?php

namespace Omnipay\Buckaroo\Gateway;

class Transaction extends AbstractGateway
{
    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'Buckaroo Transaction';
    }

    
}