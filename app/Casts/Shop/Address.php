<?php

namespace App\Casts\Shop;

use App\DTOs\Shop\AddressDTO;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Address implements CastsAttributes
{
    /** @noinspection PhpMissingReturnTypeInspection */
    public function get($model, string $key, $value, array $attributes)
    {
        $data = json_decode($value);

        return new AddressDTO(
            street: data_get($data, 'street'),
            number: data_get($data, 'number'),
            zipCode: data_get($data, 'zip_code'),
            cityName: data_get($data, 'city_name'),
            countryName: data_get($data, 'country_name'),
        );
    }

    /** @noinspection PhpMissingReturnTypeInspection */
    public function set($model, string $key, $value, array $attributes)
    {
        return json_encode($value);
    }
}
