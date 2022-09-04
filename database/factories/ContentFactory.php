<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Content;

class ContentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Content::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'required_content' => Content::factory(),
            'title' => $this->faker->sentence(4),
            'slug' => $this->faker->slug,
            'description' => $this->faker->text,
            'type' => $this->faker->randomElement(["video","audio","exam","pdf","note","link","live","zip","file"]),
            'duration' => $this->faker->randomFloat(0, 0, 9999999999.),
            'order' => $this->faker->numberBetween(-10000, 10000),
            'paid' => $this->faker->boolean,
            'active' => $this->faker->boolean,
            'available_at' => $this->faker->dateTime(),
            'softdeletes' => $this->faker->word,
        ];
    }
}
