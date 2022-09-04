<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Content;
use App\Models\Note;

class NoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Note::class;

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
            'body' => $this->faker->text,
            'softdeletes' => $this->faker->word,
        ];
    }
}
