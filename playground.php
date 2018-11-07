<?php

require 'vendor/autoload.php';
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

interface CustomerInterface extends RetrieveInterface, UpdateInterface, DeleteInterface
{
    public function create($email, $token);
    public function getCustomerId();
}

interface RetrieveInterface
{
    public function retrieve($id);
}

interface UpdateInterface
{
    public function update($id, $data);
}

interface DeleteInterface
{
    public function delete($id);
}

class Resource
{
    protected function setProperties()
    {
        // Loop through the response object
        foreach ($this->response->keys() as $key) {
            // Set those properties on this object
            $this->{$key} = $this->response->{$key};
        }
    }
}

class Customer extends Resource implements CustomerInterface
{
    public function create($email, $token)
    {
        $this->stripe('create', [
            'email' => $email,
            'source' => $token,
        ]);

        return $this;
    }
    public function retrieve($id)
    {

    }
    public function update($id, $data)
    {

    }
    public function delete($id)
    {

    }
    public function getCustomerId()
    {
        return $this->id;
    }

    protected function stripe($method, $arguments)
    {
        $this->response = \Stripe\Customer::{$method}($arguments);
        $this->setProperties();
    }
}

class Charge extends Resource
{

    public function create(CustomerInterface $customer, $amount)
    {
        $this->stripe('create', [
            'customer' => $customer->getCustomerId(),
            'currency' => 'usd',
            'amount' => $amount * 100,
        ]);

        return $this;
    }

    protected function stripe($method, $arguments)
    {
        $this->response = \Stripe\Charge::{$method}($arguments);
        $this->setProperties();
    }
}

class Strype
{
    public function __construct($apikey)
    {
        \Stripe\Stripe::setApiKey($apikey);
    }

    public function customer()
    {
        return new Customer;
    }

    public function charge(CustomerInterface $customer, $amount)
    {
        $charge = new Charge;

        return $charge->create($customer, $amount);
    }
}

//$customer = new Customer;
//$customer->create('levi.durfee@gmail.com', 'tok_amex');
//var_dump($customer->getCustomerId());

$strype = new Strype(getenv('STRIPE_API_KEY'));
$customer = $strype->customer()->create('levi.durfee@gmail.com', 'tok_visa');
$charge = $strype->charge($customer, 50);
var_dump($charge);
