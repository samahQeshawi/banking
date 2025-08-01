<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $now = Carbon::now();

        DB::table('admins')->insert([
            [
                'name' => 'Ali Al-Sahli',
                'email' => 'admin@gmail.com',
                'phone' => '01008292922',
                'password' => Hash::make('123456'),
                'image' => 'admin1.png',
                'otp' => '1234',
                'is_verified' => 1,
                'status' => 1,
                'remember_token' => Str::random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Samah Ibrahim',
                'email' => 'samah@example.com',
                'phone' => '0545083533',
                'password' => Hash::make('123456'),
                'image' => 'admin2.png',
                'otp' => '5678',
                'is_verified' => 1,
                'status' => 1,
                'remember_token' => Str::random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'name' => 'Khadija Ahmad',
                'email' => 'khadija@example.com',
                'phone' => '0545083544',
                'password' => Hash::make('123456'),
                'image' => 'admin3.png',
                'otp' => '5678',
                'is_verified' => 1,
                'status' => 1,
                'remember_token' => Str::random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'name' => 'Mohammed Sahli',
                'email' => 'mohammed@example.com',
                'phone' => '0545083555',
                'password' => Hash::make('123456'),
                'image' => 'admin4.png',
                'otp' => '5678',
                'is_verified' => 1,
                'status' => 1,
                'remember_token' => Str::random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'name' => 'khalel Sahli',
                'email' => 'khalel@example.com',
                'phone' => '0545083566',
                'password' => Hash::make('123456'),
                'image' => 'admin5.png',
                'otp' => '5678',
                'is_verified' => 1,
                'status' => 1,
                'remember_token' => Str::random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'name' => 'basma mostafa',
                'email' => 'basma@example.com',
                'phone' => '0545083577',
                'password' => Hash::make('123456'),
                'image' => 'admin6.png',
                'otp' => '5678',
                'is_verified' => 1,
                'status' => 1,
                'remember_token' => Str::random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'name' => 'Mahmoud Sahli',
                'email' => 'mahmoud@example.com',
                'phone' => '0545083588',
                'password' => Hash::make('123456'),
                'image' => 'admin7.png',
                'otp' => '5678',
                'is_verified' => 1,
                'status' => 1,
                'remember_token' => Str::random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
