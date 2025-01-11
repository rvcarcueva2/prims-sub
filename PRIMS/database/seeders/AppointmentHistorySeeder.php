<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\AppointmentHistory;
use Illuminate\Database\Seeder;

class AppointmentHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the users' appointment history manually
        $appointments = [
            [
                'student_number' => '2022 - 187311',
                'date' => '01/02/2025',
                'time' => '7:00 - 7:30',
                'nurse_doctor' => 'Nurse Anna Torre',
                'status' => 'Completed',
            ],
            [
                'student_number' => '2022 - 187311',
                'date' => '02/03/2025',
                'time' => '7:00 - 7:30',
                'nurse_doctor' => 'Nurse Anna Torre',
                'status' => 'Completed',
            ],
            [
                'student_number' => '2022 - 187311',
                'date' => '03/04/2025',
                'time' => '7:00 - 7:30',
                'nurse_doctor' => 'Nurse Anna Torre',
                'status' => 'Completed',
            ],
            [
                'student_number' => '2022 - 187311',
                'date' => '04/05/2025',
                'time' => '7:00 - 7:30',
                'nurse_doctor' => 'Nurse Anna Torre',
                'status' => 'Completed',
            ],
            [
                'student_number' => '2022 - 187311',
                'date' => '05/06/2025',
                'time' => '7:00 - 7:30',
                'nurse_doctor' => 'Nurse Anna Torre',
                'status' => 'Completed',
            ],
        ];

        // Insert appointment history into the database
        foreach ($appointments as $appointment) {
            AppointmentHistory::create($appointment);
        }
    }
}
