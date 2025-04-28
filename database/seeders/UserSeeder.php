<?php

namespace Database\Seeders;

use App\Models\User;
use App\Utils\GlobalConstant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'first_name'        => 'Supper',
                'last_name'         => 'Student',
                'email'             => 'student@app.com',
                'email_verified_at' => now(),
                'password'          => Hash::make("12345678"),   // 12345678
                'user_type'         => User::USER_TYPE_STUDENT,
                'status'            => GlobalConstant::STATUS_ACTIVE,
                'remember_token'    => Str::random(60),
                'phone'             => '012345678910',
            ],
            [
                'first_name'        => 'Admin',
                'last_name'         => 'Last',
                'email'             => 'admin@app.com',
                'email_verified_at' => now(),
                'password'          => Hash::make("12345678"),   // 12345678
                'user_type'         => User::USER_TYPE_ADMIN,
                'status'            => GlobalConstant::STATUS_ACTIVE,
                'remember_token'    => Str::random(60),
                'phone'             => '012345678910',
            ],
            [
                'first_name'        => 'Instructor',
                'last_name'         => 'Last',
                'email'             => 'instructor@app.com',
                'email_verified_at' => now(),
                'password'          => Hash::make("12345678"),   // 12345678
                'user_type'         => User::USER_TYPE_INSTRUCTOR,
                'status'            => GlobalConstant::STATUS_ACTIVE,
                'remember_token'    => Str::random(60),
                'phone'             => '012345678910',
            ],
        ];


        foreach ($users as $user) {
            User::create($user);
        }

    }
}
