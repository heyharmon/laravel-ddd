<?php

namespace Database\Seeders;

use DDD\Domain\Users\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
// Models
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'name' => 'Ryan Harmon',
                'email' => 'ryan@bloomcu.com',
                'role' => 'admin',
                'organization_id' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make(''),
            ],
            [
                'name' => 'Derik Krauss',
                'email' => 'derik@bloomcu.com',
                'role' => 'admin',
                'organization_id' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make(''),
            ],
        ];

        foreach ($admins as $admin) {
            User::create($admin);
        }

        // $faker = \Faker\Factory::create();
        //
        // foreach (range(1, 20) as $i) {
        //     User::create([
        //         'name' => $faker->name,
        //         'email' => $faker->unique()->safeEmail,
        //         'role' => 'editor',
        //         'organization_id' => rand(1, 3),
        //         'email_verified_at' => now(),
        //         'password' => Hash::make('password'),
        //         'remember_token' => Str::random(10),
        //     ]);
        // }
    }
}
