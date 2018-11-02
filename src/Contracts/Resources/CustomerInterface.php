<?php

namespace Bulldog\Strype\Contracts\Resources;

interface CustomerInterface
{
    /**
     * Creates a new customer object.
     *
     * @see https://stripe.com/docs/api/customers/create?lang=php
     *
     * @param string $email       Customer’s email address
     * @param string $description A string that you can attach to a customer
     * @param mixed  $token       A Token as returned by Elements
     * @param array  $arguments   An array of additional arguments for Stripe
     *
     * @return Customer
     */
    public function create($email, $description, $token, $arguments = []);

    /**
     * Retrieves the details of an existing customer. You need only supply the
     * unique customer identifier that was returned upon customer creation.
     *
     * @see https://stripe.com/docs/api/customers/retrieve?lang=php
     *
     * @param string $customerid The identifier of the customer to be retrieved
     */
    public function retrieve($customerid);

    /**
     * Updates the specified customer by setting the values of the parameters passed.
     *
     * @see https://stripe.com/docs/api/customers/update?lang=php
     *
     * @param string $customerid The identifier of the customer to be retrieved
     * @param array  $arguments  An array of additional arguments for Stripe
     */
    public function update($customerid, $arguments);

    /**
     * Permanently deletes a customer. It cannot be undone. Also immediately
     * cancels any active subscriptions on the customer.
     *
     * @see https://stripe.com/docs/api/customers/delete?lang=php
     *
     * @param string $customerid The identifier of the customer to be retrieved
     */
    public function delete($customerid);

    /**
     * Returns a list of your customers. The customers are returned sorted by
     * creation date, with the most recent customers appearing first.
     *
     * @see https://stripe.com/docs/api/customers/list
     *
     * @param array $arguments
     */
    public function listAll($arguments = []);
}
