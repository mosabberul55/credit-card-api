<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Content;
use App\Models\Exam;

class ExamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Exam::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'content_id' => Content::factory(),
            'title' => $this->faker->sentence(4),
            'slug' => $this->faker->slug,
            'mode' => $this->faker->word,
            'duration' => $this->faker->numberBetween(-10000, 10000),
            'description' => $this->faker->text,
            'per_question_mark' => $this->faker->randomFloat(0, 0, 9999999999.),
            'negative_mark' => $this->faker->randomFloat(0, 0, 9999999999.),
            'pass_mark' => $this->faker->randomFloat(0, 0, 9999999999.),
            'strict' => $this->faker->boolean,
            'start_time' => $this->faker->dateTime(),
            'end_time' => $this->faker->dateTime(),
            'result_publish_time' => $this->faker->dateTime(),
            'total_subject' => $this->faker->numberBetween(-10000, 10000),
            'retry_limit' => $this->faker->numberBetween(-10000, 10000),
            'softdeletes' => $this->faker->word,
        ];
    }
}
