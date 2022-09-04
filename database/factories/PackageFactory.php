<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Package;

class PackageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Package::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'slug' => $this->faker->slug,
            'subtitle' => $this->faker->word,
            'description' => $this->faker->text,
            'requirement' => $this->faker->text,
            'outcome' => $this->faker->text,
            'featured' => $this->faker->boolean,
            'price' => $this->faker->randomFloat(0, 0, 9999999999.),
            'discount' => $this->faker->randomFloat(0, 0, 9999999999.),
            'discount_till' => $this->faker->dateTime(),
            'discounted_price' => $this->faker->randomFloat(0, 0, 9999999999.),
            'approved' => $this->faker->boolean,
            'active' => $this->faker->boolean,
            'softdeletes' => $this->faker->word,
        ];
    }
}
