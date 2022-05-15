<?php

namespace App\Enums\Shop;

use BenSampo\Enum\Enum;

final class OrderStatusType extends Enum
{
    const CREATED = 0;

    const ACCEPTED = 1;

    const PAID = 2;

    const COMPLETED = 3;

    const CANCELED = 4;
}
