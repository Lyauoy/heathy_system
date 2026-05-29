<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Department;
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
        $adminRole = Role::create(['name' => 'admin', 'description' => 'Administrator']);
        $doctorRole = Role::create(['name' => 'doctor', 'description' => 'Doctor']);
        $patientRole = Role::create(['name' => 'patient', 'description' => 'Patient']);
        $employeeRole = Role::create(['name' => 'employee', 'description' => 'Employee']);

        // Create admin user
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@su30.com',
            'password' => Hash::make('admin123'),
            'role_id' => $adminRole->id,
        ]);

        // Create some departments
        $departments = [
            ['name' => 'Cardiology', 'description' => 'Heart and cardiovascular system'],
            ['name' => 'Neurology', 'description' => 'Brain and nervous system'],
            ['name' => 'Orthopedics', 'description' => 'Bones and muscles'],
            ['name' => 'Pediatrics', 'description' => 'Children health'],
            ['name' => 'General Medicine', 'description' => 'General health care'],
        ];

        foreach ($departments as $dept) {
            Department::create($dept);
        }
    }
}
