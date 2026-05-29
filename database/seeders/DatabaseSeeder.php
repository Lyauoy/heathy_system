<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Doctor;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create roles
        $adminRole = Role::firstOrCreate(
            ['name' => 'admin'],
            ['description' => 'Administrator']
        );

        $doctorRole = Role::firstOrCreate(
            ['name' => 'doctor'],
            ['description' => 'Doctor']
        );

        $patientRole = Role::firstOrCreate(
            ['name' => 'patient'],
            ['description' => 'Patient']
        );

        $employeeRole = Role::firstOrCreate(
            ['name' => 'employee'],
            ['description' => 'Employee']
        );

        // Create admin user
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Admin',
                'email' => 'admin@su30.com',
                'password' => Hash::make('admin123'),
                'role_id' => $adminRole->id,
            ]
        );

        // Create doctor user
        $doctorUser = User::updateOrCreate(
            ['username' => 'doctor'],
            [
                'name' => 'Doctor',
                'email' => 'doctor@su30.com',
                'password' => Hash::make('doctor123'),
                'role_id' => $doctorRole->id,
            ]
        );

        // Create some departments
        $departments = [
            ['name' => 'Cardiology', 'description' => 'Heart and cardiovascular system'],
            ['name' => 'Neurology', 'description' => 'Brain and nervous system'],
            ['name' => 'Orthopedics', 'description' => 'Bones and muscles'],
            ['name' => 'Pediatrics', 'description' => 'Children health'],
            ['name' => 'General Medicine', 'description' => 'General health care'],
        ];

        foreach ($departments as $dept) {
            Department::firstOrCreate($dept);
        }

        $defaultDepartment = Department::firstWhere('name', 'General Medicine') ?? Department::first();

        Doctor::updateOrCreate(
            ['user_id' => $doctorUser->id],
            [
                'department_id' => $defaultDepartment->id,
                'license_number' => 'DOC-0001',
                'specialization' => 'General Practitioner',
                'bio' => 'Seeded doctor account for login.',
                'phone' => '081234567890',
            ]
        );
    }
}
