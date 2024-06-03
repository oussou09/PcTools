<?php

namespace Database\Seeders;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'username' => 'admin01',
                'email' => 'admin01@admin.ma',
                'password' => Hash::make('1010'),
            ],
            [
                'username' => 'admin02',
                'email' => 'admin02@admin.ma',
                'password' => Hash::make('1010'),
            ]
            ];
            Admin::insert($admins);
    }
}
// php artisan db:seed --class=AdminSeeder