<?php

namespace Database\Factories\Cache;

use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'                     => $this->faker->sentence(10),
            'basic_description_md'     => $this->faker->text(2056),
            'basic_description_html'   => $this->faker->randomHtml(15),
            'basic_description_xml'    => $this->faker->text(2056),
            'basic_description_yml'    => $this->faker->text(2056),
            'basic_description_json'   => json_encode(
                array_fill(0, 10, $this->faker->text(256))
            ),
            'basic_description_csv'    => $this->faker->text(2056),
            'basic_description_txt'    => $this->faker->text(2056),
            'meta'                     => json_encode(
                array_fill(0, 10, $this->faker->text(256))
            ),
            'mesh_base64'              => $this->faker->text(2056),
            'decimal_degree_latitude'  => $this->faker->randomNumber(5) * 0.0001,
            'decimal_degree_longitude' => $this->faker->randomNumber(5) * 0.001,
        ];
    }
}
