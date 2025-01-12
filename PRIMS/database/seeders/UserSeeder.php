<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //
        $users = [
            [
                'email' => 'smcatingub@sample.com',
                'password' => 'sample123',
                'role' => 'patient',
            ],
            [
                'email' => 'patient@sample.com',
                'password' => 'sample123',
                'role' => 'patient',
            ],
            [
                'email' => 'staff@sample.com',
                'password' => 'sample123',
                'role' => 'staff',
            ],
        ];

        foreach($users as $user) {
            $created_user = User::create([
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
            ]);

            $created_user->assignRole($user['role']);
        }
    }
}
