<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'originuser',
            'email' => 'example@example.co.jp',
            'password' => bcrypt('12345678'),
            'role' => '2',
            'email_verified_at' => date('Y-m-d H:i:s'),

        ];
        $user = new User;
        $user->fill($param)->save();
    }
}
