<?php

namespace Omnipay\Buckaroo\Message\Response;

use Omnipay\Common\Message\AbstractResponse;

abstract class AbstractBuckarooResponse extends AbstractResponse
{
    // The transaction has succeeded and the payment has been received/approved.
    const STATUS_SUCCESS = 190;
    // The transaction has failed.
    const STATUS_FAILED = 490;
    // The transaction request contained errors and could not be processed correctly
    const STATUS_VALIDATION_FAILURE = 491;
    // Some technical failure prevented the completion of the transactions
    const STATUS_TECHNICAL_FAILURE = 492;
    // The transaction was cancelled by the customer.
    const STATUS_CANCELLED_BY_USER = 890;
    // The merchant cancelled the transaction.
    const STATUS_CANCELLED_BY_MERCHANT = 891;
    // The transaction has been rejected by the (third party) payment provider.
    const STATUS_REJECTED = 690;
    // The transaction is on hold while the payment engine is waiting on further input from the consumer.
    const STATUS_PENDING_INPUT = 790;
    // The transaction is being processed.
    const STATUS_PENDING_PROCESSING = 791;
    // The Payment Engine is waiting for the consumer to return from a third party website, needed to complete the transaction.
    const STATUS_AWAITING_CONSUMER = 792;

    /**
     * @inheritDoc
     */
    public function isSuccessful(): bool
    {
        if (isset($this->data['Status']['Code']['Code']) && $this->data['Status']['Code']['Code'] == self::STATUS_SUCCESS) {
            return true;
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    public function isCancelled(): bool
    {
        if (
            isset($this->data['Status']['Code']['Code']) &&
            in_array($this->data['Status']['Code']['Code'], [
                self::STATUS_CANCELLED_BY_MERCHANT,
                self::STATUS_CANCELLED_BY_USER
            ])
        ) {
            return true;
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    public function isPending(): bool
    {
        if (
            isset($this->data['Status']['Code']['Code']) &&
            in_array($this->data['Status']['Code']['Code'], [
                self::STATUS_PENDING_INPUT,
                self::STATUS_PENDING_PROCESSING
            ])
        ) {
            return true;
        }

        return false;
    }


}