<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\McqStore;

class McqStoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = McqStore::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'mcq_store_id' => McqStore::factory(),
            'name' => $this->faker->name,
            'order' => $this->faker->numberBetween(-10000, 10000),
            'active' => $this->faker->boolean,
            'softdeletes' => $this->faker->word,
        ];
    }
}
