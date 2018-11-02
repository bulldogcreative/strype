<?php

namespace Bulldog\Strype;

use Bulldog\Strype\Contracts\CustomerPaymentInterface;
use Bulldog\Strype\Contracts\Resources\CustomerInterface;

/**
 * Customer objects allow you to perform recurring charges, and to track
 * multiple charges, that are associated with the same customer. The API allows
 * you to create, delete, and update your customers. You can retrieve individual
 * customers as well as a list of all your customers.
 *
 * This class also implements the ResourceInterface since it extends Resource
 */
class Customer extends Resource implements CustomerPaymentInterface, CustomerInterface
{
    /**
     * Unique identifier for the object.
     *
     * Needed for ResourceInterface
     *
     * @var string
     */
    protected $id;

    /**
     * Has the value true if the object exists in live mode or the value false
     * if the object exists in test mode.
     *
     * Needed for ResourceInterface
     *
     * @var bool
     */
    protected $livemode;

    /**
     * Customer’s email address.
     *
     * It’s displayed alongside the customer in your dashboard and can be
     * useful for searching and tracking. This may be up to 512 characters.
     * This can be unset by updating the value to null and then saving.
     *
     * @var string
     */
    protected $email;

    /**
     * An arbitrary string that you can attach to a customer object.
     *
     * It is displayed alongside the customer in the dashboard. This can be
     * unset by updating the value to null and then saving.
     *
     * @var string
     */
    protected $description;

    /**
     * The source can either be a Token or a Source, as returned by Elements,
     * or a associative array containing a user’s credit card details.
     *
     * You must provide a source if the customer does not already have a valid
     * source attached, and you are subscribing the customer to be charged
     * automatically for a plan that is not free. Passing source will create a
     * new source object, make it the customer default source, and delete the
     * old customer default if one exists. If you want to add an additional
     * source, instead use the card creation API to add the card and then the
     * customer update API to set it as the default. Whenever you attach a card
     * to a customer, Stripe will automatically validate the card.
     *
     * @var mixed
     */
    protected $token;

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
    public function create($email, $description, $token, $arguments = [])
    {
        $arguments['email'] = $email;
        $arguments['description'] = $description;
        $arguments['source'] = $token;

        $this->stripe('create', $arguments);

        return $this;
    }

    /**
     * Retrieves the details of an existing customer. You need only supply the
     * unique customer identifier that was returned upon customer creation.
     *
     * @see https://stripe.com/docs/api/customers/retrieve?lang=php
     *
     * @param string $customerid The identifier of the customer to be retrieved
     */
    public function retrieve($customerid)
    {
        $this->stripe('retrieve', $customerid);

        return $this;
    }

    /**
     * Updates the specified customer by setting the values of the parameters passed.
     *
     * @see https://stripe.com/docs/api/customers/update?lang=php
     *
     * @param string $customerid The identifier of the customer to be retrieved
     * @param array  $arguments  An array of additional arguments for Stripe
     */
    public function update($customerid, $arguments)
    {
        $this->stripe('retrieve', $customerid);

        foreach ($arguments as $key => $value) {
            // Update the local property
            $this->{$key} = $value;
            // Update the response object
            $this->response->{$key} = $value;
        }

        // Call save method on the response to save the changes to Stripe
        $this->response->save();

        return $this;
    }

    /**
     * Permanently deletes a customer. It cannot be undone. Also immediately
     * cancels any active subscriptions on the customer.
     *
     * @see https://stripe.com/docs/api/customers/delete?lang=php
     *
     * @param string $customerid The identifier of the customer to be retrieved
     */
    public function delete($customerid)
    {
        $this->stripe('retrieve', $customerid);
        $this->response->delete();
        $this->deleted = true;

        return $this;
    }

    /**
     * Returns a list of your customers. The customers are returned sorted by
     * creation date, with the most recent customers appearing first.
     *
     * @see https://stripe.com/docs/api/customers/list
     *
     * @param array $arguments
     */
    public function listAll($arguments = [])
    {
        $this->stripe('all', $arguments);

        return $this;
    }

    /**
     * Get the Customer ID.
     *
     * Implemented for CustomerPaymentInterface
     *
     * @return string
     */
    public function getCustomerId(): string
    {
        return $this->id;
    }
}
