<?php

namespace Strype;

class TokenTest extends TestCase
{
    public function testCreateCard()
    {
        $token = $this->strype->token()->createCard(
            '4242424242424242',
            '09',
            '29',
            '123',
            [],
            $this->id->get(12)
        );
        $this->assertEquals('token', $token->object);
    }

    public function testCreateBankAccount()
    {
        $token = $this->strype->token()->createBankAccount(
            'us',
            'usd',
            'Jenny fromDa Block',
            'individual',
            '110000000',
            '000123456789',
            [],
            $this->id->get(12)
        );
        $this->assertEquals('token', $token->object);
    }

    public function testCreatePii()
    {
        $token = $this->strype->token()->createPii('1234', $this->id->get(12));
        $this->assertEquals('token', $token->object);
    }

    public function testCreateAccount()
    {
        $token = $this->strype->token()->createAccount([
            'account' => [
                'legal_entity' => [
                    'first_name' => 'Jane',
                    'last_name' => 'Doe',
                ],
            ],
        ], $this->id->get(12));
        $this->assertEquals('token', $token->object);
    }
}
