<?php

namespace Database\Factories;

use App\Models\Resource;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Factory for creating Resource instances.
 *
 * @extends Factory<Resource>
 */
class ResourceFactory extends Factory{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array{
        return [
            'title' => ucfirst($this->faker->words(3, true)),
            'description' => $this->faker->paragraph(),
            'link' => $this->faker->url(),
            'file_path' => null, // optional for now
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
        ];
    }
}
