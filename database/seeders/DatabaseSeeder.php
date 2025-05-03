<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Topic;
use App\Models\Resource;

/**
 * Main Database Seeder class.
 *
 * Seeds the database with initial data:
 * - Demo user
 * - Topics
 * - Resources
 */
class DatabaseSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void{

        $this->call([
            UserSeeder::class,
        ]);

        Topic::factory(10)->create();
        Resource::factory(20)->create();
    }
}
