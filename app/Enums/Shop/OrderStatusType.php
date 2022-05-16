<?php

namespace App\Enums\Shop;

use BenSampo\Enum\Enum;

final class OrderStatusType extends Enum
{
    const CREATED = 0;

    const PAYMENT_INITIALIZED = 1;

    const PAID = 2;

    const ACCEPTED = 3;

    const PREPARED = 4;

    const SENT = 5;

    const SHIPPED = 6;

    const COMPLETED = 7;

    const CANCELED = 8;

    const RETURN_REQUESTED = 9;

    const RETURNED = 10;
}
