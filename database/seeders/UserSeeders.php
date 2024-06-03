<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class UserSeeders extends Seeder
{
    public function run()
    {
        $users = [
            ['John Doe', 'john.doe@example.com'],
            ['Jane Smith', 'jane.smith@example.com'],
            ['Alice Johnson', 'alice.johnson@example.com'],
            ['Bob Brown', 'bob.brown@example.com'],
            ['Carol White', 'carol.white@example.com'],
            ['David Green', 'david.green@example.com'],
            ['Eve Black', 'eve.black@example.com'],
            ['Frank Gray', 'frank.gray@example.com'],
            ['Grace Hall', 'grace.hall@example.com'],
            ['Henry Ford', 'henry.ford@example.com']
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData[1]], // Check by email
                [
                    'name' => $userData[0],
                    'email_verified_at' => Carbon::now(),
                    'password' => Hash::make('defaultPassword123'), // Use a real password in practice
                    'remember_token' => Str::random(10),
                    'account_type' => Arr::random([true, false]), // Randomly assign account type
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]
            );
        }
    }
}

// php artisan db:seed --class=UserSeeders
