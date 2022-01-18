<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@dev.com',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'user_type' => 'admin',
            'occupation' => 'Administrator',
            'phone'     => '+31 123456789',
            'image_name'    => 'user.png',
            'website_url'   => '',
            'company_id'    => '1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
