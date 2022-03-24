<?php

namespace Omnipay\Buckaroo\Message\Ideal;

use Omnipay\Buckaroo\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

class PurchaseResponse extends AbstractResponse implements RedirectResponseInterface
{

    public function isSuccessful(): bool
    {
        return false;
    }
}