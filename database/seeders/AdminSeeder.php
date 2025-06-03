<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        DB::table('admins')->insert([
            'name' => 'Super Admin',
            'email' => 'uyu365656@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('ahmed1234'), // You should change this in production
            'image_path' => 'profile.png',
            'status' => 'active',
            'phone' => '+1234567890',
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

       
    }
}