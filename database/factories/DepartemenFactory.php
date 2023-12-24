<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Departemen>
 */
class DepartemenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'departemen_name' => fake()->randomElement(["Human Safety Environment", "Human Resource Development & General Affair","Mine Operation","Logistic","Plant","Finance","TAX","Geologi & Explorasi","Barging & Shipping","Production"])
        ];
    }
}
