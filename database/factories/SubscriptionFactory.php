<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Subscription;
use App\Models\User;

class SubscriptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subscription::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'valid_till' => $this->faker->dateTime(),
            'status' => $this->faker->randomElement(["active","expired","pending","banned","rejected","blocked","trial"]),
            'softdeletes' => $this->faker->word,
        ];
    }
}
