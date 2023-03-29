<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ShopsTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        \App\Models\Favorite::factory(8)
            ->create();
        \App\Models\Reserve::factory(30)
            ->create();
        \App\Models\User::factory(20)
            ->create();
    }
}
