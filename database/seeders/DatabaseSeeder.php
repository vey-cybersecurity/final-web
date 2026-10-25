<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Demo Administrator Account (Local Demonstration Data)
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Demo Administrator',
                'password' => Hash::make('Password123!'),
            ]
        );

        // 2. Academic Departments
        $it = Department::firstOrCreate(
            ['name' => 'IT'],
            ['description' => 'Department of Information Technology, Software Engineering, and Computer Systems']
        );

        $business = Department::firstOrCreate(
            ['name' => 'Business'],
            ['description' => 'Department of Business Administration, Marketing, and International Trade']
        );

        $accounting = Department::firstOrCreate(
            ['name' => 'Accounting'],
            ['description' => 'Department of Accounting, Finance, Auditing, and Taxation']
        );

        // 3. Fifteen Sample Students with Cambodian Names (Latin Characters)
        $students = [
            // IT Department
            [
                'department_id' => $it->id,
                'student_code' => 'STU-IT-001',
                'name' => 'Sokha Chan',
                'gender' => 'Male',
                'dob' => '2004-03-15',
                'phone' => '+855 12 789 001',
            ],
            [
                'department_id' => $it->id,
                'student_code' => 'STU-IT-002',
                'name' => 'Bopha Pich',
                'gender' => 'Female',
                'dob' => '2003-08-22',
                'phone' => '+855 10 456 002',
            ],
            [
                'department_id' => $it->id,
                'student_code' => 'STU-IT-003',
                'name' => 'Rithy Meng',
                'gender' => 'Male',
                'dob' => '2004-11-05',
                'phone' => '+855 77 123 003',
            ],
            [
                'department_id' => $it->id,
                'student_code' => 'STU-IT-004',
                'name' => 'Channary Heng',
                'gender' => 'Female',
                'dob' => '2005-01-30',
                'phone' => '+855 92 654 004',
            ],
            [
                'department_id' => $it->id,
                'student_code' => 'STU-IT-005',
                'name' => 'Visal Som',
                'gender' => 'Male',
                'dob' => '2003-06-18',
                'phone' => '+855 16 987 005',
            ],

            // Business Department
            [
                'department_id' => $business->id,
                'student_code' => 'STU-BUS-001',
                'name' => 'Kosal Chea',
                'gender' => 'Male',
                'dob' => '2004-05-12',
                'phone' => '+855 89 321 006',
            ],
            [
                'department_id' => $business->id,
                'student_code' => 'STU-BUS-002',
                'name' => 'Sreymom Keo',
                'gender' => 'Female',
                'dob' => '2003-12-09',
                'phone' => '+855 98 741 007',
            ],
            [
                'department_id' => $business->id,
                'student_code' => 'STU-BUS-003',
                'name' => 'Dara Vong',
                'gender' => 'Male',
                'dob' => '2005-02-14',
                'phone' => '+855 11 852 008',
            ],
            [
                'department_id' => $business->id,
                'student_code' => 'STU-BUS-004',
                'name' => 'Neary Ouk',
                'gender' => 'Female',
                'dob' => '2004-09-25',
                'phone' => '+855 70 963 009',
            ],
            [
                'department_id' => $business->id,
                'student_code' => 'STU-BUS-005',
                'name' => 'Vannak Mao',
                'gender' => 'Male',
                'dob' => '2003-04-03',
                'phone' => '+855 81 147 010',
            ],

            // Accounting Department
            [
                'department_id' => $accounting->id,
                'student_code' => 'STU-ACC-001',
                'name' => 'Kalyan Nhem',
                'gender' => 'Female',
                'dob' => '2004-07-19',
                'phone' => '+855 17 258 011',
            ],
            [
                'department_id' => $accounting->id,
                'student_code' => 'STU-ACC-002',
                'name' => 'Sovann Sam',
                'gender' => 'Male',
                'dob' => '2003-10-31',
                'phone' => '+855 93 369 012',
            ],
            [
                'department_id' => $accounting->id,
                'student_code' => 'STU-ACC-003',
                'name' => 'Theary Lim',
                'gender' => 'Female',
                'dob' => '2005-04-08',
                'phone' => '+855 15 482 013',
            ],
            [
                'department_id' => $accounting->id,
                'student_code' => 'STU-ACC-004',
                'name' => 'Bunthorn Ros',
                'gender' => 'Male',
                'dob' => '2004-01-27',
                'phone' => '+855 86 593 014',
            ],
            [
                'department_id' => $accounting->id,
                'student_code' => 'STU-ACC-005',
                'name' => 'Montha Prom',
                'gender' => 'Female',
                'dob' => '2003-09-14',
                'phone' => '+855 69 714 015',
            ],
        ];

        foreach ($students as $studentData) {
            Student::firstOrCreate(
                ['student_code' => $studentData['student_code']],
                $studentData
            );
        }
    }
}
