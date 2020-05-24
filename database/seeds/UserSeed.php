<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'full_name' => 'Lê Văn Thành',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);
        DB::table('users')->insert([
            'full_name' => 'Khach mua hang',
            'email' => 'guest@gmail.com',
            'password' => bcrypt('123456'),
            'is_admin' => false,
        ]);
    }
}
