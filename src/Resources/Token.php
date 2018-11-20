<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Traits\Retrieve;
use Bulldog\Strype\Contracts\Resources\TokenInterface;

/**
 * Tokenization is the process Stripe uses to collect sensitive card or bank account
 * details, or personally identifiable information (PII), directly from your customers
 * in a secure manner. A token representing this information is returned to your server
 * to use. You should use Checkout, Elements, or our mobile libraries to perform this
 * process, client-side. This ensures that no sensitive card data touches your server,
 * and allows your integration to operate in a PCI-compliant way.
 *
 * @see https://stripe.com/docs/api/tokens
 */
class Token extends Resource implements TokenInterface
{
    use Retrieve;

    /**
     * Creates a single-use token that represents a credit card’s details. This
     * token can be used in place of a credit card associative array with any API
     * method. These tokens can be used only once: by creating a new Charge object,
     * or by attaching them to a Customer object.
     *
     * @see https://stripe.com/docs/api/tokens/create_card
     *
     * @param int    $number
     * @param int    $expMonth
     * @param int    $expYear
     * @param int    $cvc
     * @param array  $arguments
     * @param string $key
     *
     * @return TokenInterface
     */
    public function createCard(int $number, int $expMonth, int $expYear, int $cvc, array $arguments = [], string $key = null): TokenInterface
    {
        $arguments['card']['number'] = $number;
        $arguments['card']['exp_month'] = $expMonth;
        $arguments['card']['exp_year'] = $expYear;
        $arguments['card']['cvc'] = $cvc;

        $this->stripe('create', $arguments, $key);

        return $this;
    }

    /**
     * Creates a single-use token that represents a bank account’s details. This
     * token can be used in place of a bank account associative array with any
     * API method. These tokens can be used only once: by attaching them to a
     * recipient or Custom account.
     *
     * @see https://stripe.com/docs/api/tokens/create_bank_account
     *
     * @param string $country
     * @param string $currency
     * @param string $accountHolderName
     * @param string $accountHolderType
     * @param int    $routingNumber
     * @param int    $accountNumber
     * @param array  $arguments
     * @param string $key
     *
     * @return TokenInterface
     */
    public function createBankAccount(string $country, string $currency, string $accountHolderName, string $accountHolderType, int $routingNumber, int $accountNumber, array $arguments = [], string $key = null): TokenInterface
    {
        $arguments['bank_account']['country'] = $country;
        $arguments['bank_account']['currency'] = $currency;
        $arguments['bank_account']['account_holder_name'] = $accountHolderName;
        $arguments['bank_account']['account_holder_type'] = $accountHolderType;
        $arguments['bank_account']['routing_number'] = $routingNumber;
        $arguments['bank_account']['account_number'] = $accountNumber;

        $this->stripe('create', $arguments, $key);

        return $this;
    }

    /**
     * Creates a single-use token that represents the details of personally
     * identifiable information (PII). This token can be used in place of a
     * personal_id_number in the Account Update API method. A PII token can
     * be used only once.
     *
     * @see https://stripe.com/docs/api/tokens/create_pii
     *
     * @param string $personalIdNumber
     * @param string $key
     *
     * @return TokenInterface
     */
    public function createPii(string $personalIdNumber, string $key = null): TokenInterface
    {
        $this->stripe('create', [
            'pii' => [
                'personal_id_number' => $personalIdNumber,
            ],
            ], $key);

        return $this;
    }

    /**
     * Creates a single-use token that wraps a user’s legal entity information.
     * Use this when creating or updating a Connect account. See the account
     * tokens documentation to learn more.
     *
     * @see https://stripe.com/docs/api/tokens/create_account
     *
     * @param array  $arguments
     * @param string $key
     *
     * @return TokenInterface
     */
    public function createAccount(array $arguments = [], string $key = null): TokenInterface
    {
        $this->stripe('create', $arguments, $key);

        return $this;
    }

    protected function stripe(string $method, $arguments, string $idempotencyKey = null): void
    {
        $this->response = \Stripe\Token::{$method}($arguments, [
            'idempotency_key' => $idempotencyKey,
        ]);
        $this->setProperties();
    }
}
