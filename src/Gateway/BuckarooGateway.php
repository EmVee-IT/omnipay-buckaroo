<?php namespace Omnipay\Buckaroo\Gateway;

use Omnipay\Common\AbstractGateway;

class BuckarooGateway extends AbstractGateway
{
    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'Buckaroo Gateway';
    }

    /**
     * @inheritDoc
     */
    public function getDefaultParameters(): array
    {
        return [
            'websiteKey' => null,
            'secretKey' => null,
            'testMode' => false
        ];
    }

    /**
     * Set secret key - Needed for encrypting HMAC for authorization header
     *
     * This can be found in https://plaza.buckaroo.nl/Configuration/Merchant/SecretKey
     * Buckaroo Plaza -> Configuration -> Security -> Secret Key
     * @param string $secretKey
     * @return BuckarooGateway
     */
    public function setSecretKey(string $secretKey): BuckarooGateway
    {
        return $this->setParameter('secretKey', $secretKey);
    }

    /**
     * Get secret key
     *
     * More information @see BuckarooGateway::setSecretKey
     * @return string
     */
    public function getSecretKey(): string
    {
        return $this->getParameter('secretKey');
    }

    /**
     * Set website key - Needed for encrypting HMAC for authorization header
     *
     * This can be found in https://plaza.buckaroo.nl/Configuration/Website/Index/
     * Buckaroo Plaza -> My Buckaroo -> Websites
     *
     * @param string $websiteKey
     * @return BuckarooGateway
     */
    public function setWebsiteKey(string $websiteKey): BuckarooGateway
    {
        return $this->setParameter('websiteKey', $websiteKey);
    }

    /**
     * Get website key
     *
     * More information @see BuckarooGateway::setWebsiteKey
     * @return string
     */
    public function getWebsiteKey(): string
    {
        return $this->getParameter('websiteKey');
    }
}