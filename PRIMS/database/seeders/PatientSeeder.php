<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Patient;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Fetch all users who are patients
        $users = User::all();

        foreach ($users as $user) {
            if ($user->hasRole('patient')) {
                Patient::create([
                    'user_id' => $user->id,
                    'first_name' => 'Shannelien Mae',
                    'middle_initial' => 'M',
                    'last_name' => 'Catingub',
                    'email' => $user->email,
                    'gender' => 'Female',
                    'date_of_birth' => '2003-12-29',
                    'contact_number' => '09123456789',
                ]); 
            }
        }
    }
}
