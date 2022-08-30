<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $billed = fake()->dateTime();
        $status = fake()->randomElement(['billed', 'paid', 'void']);
        $paid_date = ($status=='paid'? fake()->dateTimeBetween($billed): null);

        return [
            'customer_id' => Customer::factory(),
            'amount' => fake()->randomFloat(2, 10, 1000),
            'status' => $status,
            'billed_date' => $billed,
            'paid_date' => $paid_date
        ];
    }
}
