<?php

namespace Omnipay\Buckaroo\Traits;

use Omnipay\Buckaroo\Message\Request\Subscriptions\SubscriptionsInterface;

/**
 * @method getParameter($parameter)
 * @method setParameter($parameters, $value)
 */
trait Subscriptions
{
    protected $availableParameters = [
        'configurationCode' => [
            'required' => true,
            'name' => 'ConfigurationCode',
            'group' => null,
            'description' => 'The unique code of the subscription configuration'
        ],
        'ratePlanCode' => [
            'required' => true,
            'name' => 'RatePlanCode',
            'group' => 'Addrateplan',
            'description' => 'The unique code of the Product Rate Plan.'
        ],
        'startDate' => [
            'required' => true,
            'name' => 'StartDate',
            'group' => 'Addrateplan',
            'description' => 'The start date of the rateplan (yyyy-mm-dd). Required if a rateplan is added.'
        ],
        'endDate' => [
            'required' => false,
            'name' => 'EndDate',
            'group' => 'Addrateplan',
            'description' => 'The end date of the rateplan (yyyy-mm-dd). If provided, it should be equal to or later than the StartDate.'
        ],
        'termStartDay' => [
            'required' => false,
            'name' => 'TermStartDay',
            'group' => null,
            'description' => 'The term start day determines when a subscription term starts. The value depends on the chosen invoice interval: weekly/four weekly: 1 to 7, monthly/2 monthly/quarterly/half yearly/yearly: 1 to 31. Only provide this parameter if it differs from the default value in provided rate plan.'
        ],
        'termStartMonth' => [
            'required' => false,
            'name' => 'TermStartMonth',
            'group' => null,
            'description' => 'The term start month determines when a subscription term starts. The value depends on the chosen invoice interval: 2 monthly: 1 to 2. Quarterly: 1 to 3. Half yearly: 1 to 6. Yearly: 1 to 12. Only provide this parameter if it differs from the default value in provided rate plan.'
        ],
        'billingTiming' => [
            'required' => false,
            'name' => 'BillingTiming',
            'group' => null,
            'description' => 'To bill in advance or in arrears of a period. InAdvance = 1, InArrears = 2. Only provide this parameter if it differs from the default value in provided rate plan.'
        ],
        'ratePlanChargeCode' => [
            'required' => false,
            'name' => 'RatePlanChargeCode',
            'group' => 'AddRatePlanCharge',
            'description' => 'The unique code of the Product Rate Plan Charge. Only provide this parameter if it differs from the default value in provided rate plan.'
        ],
        'baseNumberOfUnits' => [
            'required' => false,
            'name' => 'BaseNumberOfUnits',
            'group' => 'AddRatePlanCharge',
            'description' => 'The number of units. Only provide this parameter if it differs from the default value in provided rate plan. Secondly, using this parameter also requires the RatePlanChargeCode of the product.'
        ],
        'pricePerUnit' => [
            'required' => false,
            'name' => 'PricePerUnit',
            'group' => 'AddRatePlanCharge',
            'description' => 'The price per unit. Only provide this parameter if it differs from the default value in provided rate plan. Secondly, using this parameter also requires the RatePlanChargeCode of the product.'
        ],
        'debtorCode' => [
            'required' => true,
            'name' => 'Code',
            'group' => 'Debtor',
            'description' => 'A unique code by which the merchant identifies the debtor. If the debtor with this code exists, any given components are overwritten.'
        ],
        'termStartWeek' => [
            'required' => false,
            'name' => 'TermStartWeek',
            'group' => null,
            'description' => 'The term start week determines when a subscription term starts. Only applies to four weekly intervals. Possible values: 1 to 4.'
        ],
        'vatPercentage' => [
            'required' => false,
            'name' => 'VatPercentage',
            'group' => 'AddRatePlanCharge',
            'description' => 'The VAT percentage. Only provide this parameter if it differs from the default value in provided rate plan. Secondly, using this parameter also requires the RatePlanChargeCode of the product.'
        ],
        'b2b' => [
            'required' => false,
            'name' => 'B2B',
            'group' => null,
            'description' => 'Is the subscriptin to be paid via a B2B SEPA Direct Debit? Possible values: True, False. If True, then it is required to provide the MandateReference.'
        ],
        'customerIban' => [
            'required' => false,
            'name' => 'CustomerIBAN',
            'group' => null,
            'description' => 'The IBAN of the debtor. When provided, SEPA Direct Debits will be used for the (recurring) payment(s).'
        ],
        'customerAccountName' => [
            'required' => false,
            'name' => 'CustomerAccountName',
            'group' => null,
            'description' => 'The name of the debtor for the IBAN account. Required when IBAN is provided.'
        ],
        'customerBic' => [
            'required' => false,
            'name' => 'CustomerBIC',
            'group' => null,
            'description' => 'The BIC code of the IBAN account. Required when providing a non Dutch IBAN.'
        ],
        'mandateReference' => [
            'required' => false,
            'name' => 'MandateReference',
            'group' => null,
            'description' => 'The mandate reference for SEPA Direct Debits. It is possible to provide your own unique reference, or to use the mandateID from an Emandate, In any case, the MandateReference should always begin with a three digit prefix which can be found in the Sepadirectdebit subscription details in your Buckaroo account. If B2B = True is provided in the request, then the MandateReference should be registered with the customer bank for B2B SEPA Direct Debits.'
        ]
    ];
}