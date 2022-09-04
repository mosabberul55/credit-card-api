<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Photo;

class PhotoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Photo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'path' => $this->faker->word,
            'thumbnail' => $this->faker->word,
            'source' => $this->faker->word,
            'width' => $this->faker->randomFloat(0, 0, 9999999999.),
            'height' => $this->faker->randomFloat(0, 0, 9999999999.),
            'disk' => $this->faker->word,
            'softdeletes' => $this->faker->word,
        ];
    }
}
