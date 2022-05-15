<?php

namespace App\DTOs\Shop;

use App\DTOs\DataTransferObject;

class AddressDTO extends DataTransferObject
{
    public function __construct(
        public string $street,
        public string $number,
        public string $zipCode,
        public string $cityName,
        public string $countryName,
    ) {}
}