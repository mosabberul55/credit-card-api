<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Coupon;

class CouponFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Coupon::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->word,
            'discount' => $this->faker->randomFloat(0, 0, 9999999999.),
            'discount_type' => $this->faker->randomElement(["flat","percent"]),
            'expiry_date' => $this->faker->dateTime(),
            'usage_limit' => $this->faker->numberBetween(-10000, 10000),
            'used' => $this->faker->numberBetween(-10000, 10000),
            'usage_time_start' => $this->faker->dateTime(),
            'usage_time_end' => $this->faker->dateTime(),
        ];
    }
}
