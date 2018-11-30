<?php

namespace Bulldog\Strype\Resources;

use Bulldog\Strype\Resource;
use Bulldog\Strype\Contracts\Resources\PaymentIntentInterface;

/**
 * @see https://stripe.com/docs/api/payment_intents
 */
class PaymentIntent extends Resource implements PaymentIntentInterface
{
}
