<?php

namespace Database\Factories;

use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory for creating Topic instances.
 *
 * @extends Factory<Topic>
 */
class TopicFactory extends Factory{

    protected $model = Topic::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array{
        return [
            'name' => ucfirst($this->faker->words(2, true)),
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
        ];
    }
}
