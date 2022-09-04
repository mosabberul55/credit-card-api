<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Mcq;
use App\Models\McqStore;

class McqFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mcq::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'mcq_store_id' => McqStore::factory(),
            'question' => $this->faker->text,
            'question_photo' => $this->faker->word,
            'a' => $this->faker->word,
            'b' => $this->faker->word,
            'c' => $this->faker->word,
            'd' => $this->faker->word,
            'e' => $this->faker->word,
            'f' => $this->faker->word,
            'g' => $this->faker->word,
            'h' => $this->faker->word,
            'i' => $this->faker->word,
            'j' => $this->faker->word,
            'answer' => $this->faker->word,
            'answer_photo' => $this->faker->word,
            'answer_description' => $this->faker->text,
            'verified' => $this->faker->boolean,
            'difficulty_level' => $this->faker->numberBetween(-10000, 10000),
            'active' => $this->faker->boolean,
            'softdeletes' => $this->faker->word,
        ];
    }
}
