<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Package;
use App\Models\Payment;
use App\Models\User;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'package_id' => Package::factory(),
            'amount' => $this->faker->randomFloat(0, 0, 9999999999.),
            'transaction_id' => $this->faker->word,
            'method' => $this->faker->word,
            'vendor' => $this->faker->word,
            'status' => $this->faker->randomElement(["pending","accepted","rejected"]),
            'details' => $this->faker->text,
            'softdeletes' => $this->faker->word,
        ];
    }
}
