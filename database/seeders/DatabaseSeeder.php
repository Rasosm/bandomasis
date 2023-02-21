<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('users')->insert([
            'name' => 'Rasa',
            'email' => 'rasosm@gmail.com',
            'password' => Hash::make('321'),
            'role' => 'admin'
        ]);
         DB::table('users')->insert([
            'name' => 'Teja',
            'email' => 'teja@gmail.com',
            'password' => Hash::make('321'),
            'role' => 'manager'
        ]);

         $faker = Faker::create();

        foreach(range(1, 21) as $i) {
            
            DB::table('restorants')->insert([
                'title' => $faker->company,
                'town' => $faker->city,
                'address' => $faker->streetAddress,
                'time' => $faker->phoneNumber,
                
            ]);
        }

         foreach(range(1, 21) as $i) {
            
            DB::table('dishes')->insert([
                'title' => $faker->state,
                'price' => $faker->buildingNumber,
                'restorant_id' => $i
                
            ]);
        }
    }

    
}
