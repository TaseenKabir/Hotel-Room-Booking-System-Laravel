<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $faker = Faker::create();
        foreach(range(1,100) as $index) {
            DB::table('contacts')->insert([
                'name'=>$faker->name(),
                'email'=>$faker->email(),
                'phone'=>$faker->phoneNumber(),
                'message'=>$faker->sentence()
            ]);
        }
    }
}
