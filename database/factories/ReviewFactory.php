<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Review;
use App\Models\User;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'rating' => $this->faker->numberBetween(-10000, 10000),
            'title' => $this->faker->sentence(4),
            'body' => $this->faker->text,
            'softdeletes' => $this->faker->word,
        ];
    }
}
