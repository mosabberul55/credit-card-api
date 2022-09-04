<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Content;
use App\Models\Pdf;

class PdfFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pdf::class;

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
            'description' => $this->faker->text,
            'link' => $this->faker->word,
            'preview_link' => $this->faker->word,
            'download_link' => $this->faker->word,
            'source' => $this->faker->word,
            'softdeletes' => $this->faker->word,
        ];
    }
}
