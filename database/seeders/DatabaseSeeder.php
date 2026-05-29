<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Employee;
use App\Models\Invoice;
use App\Models\Message;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\Role;
use App\Models\Schedule;
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

        // Create departments
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

        $generalDepartment = Department::firstWhere('name', 'General Medicine') ?? Department::first();

        // Create admin user
        $adminUser = User::updateOrCreate(
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

        $doctor = Doctor::updateOrCreate(
            ['user_id' => $doctorUser->id],
            [
                'department_id' => $generalDepartment->id,
                'license_number' => 'DOC-0001',
                'specialization' => 'General Practitioner',
                'bio' => 'Seeded doctor account for login.',
                'phone' => '081234567890',
            ]
        );

        // Create employee user
        $employeeUser = User::updateOrCreate(
            ['username' => 'employee'],
            [
                'name' => 'Staff Employee',
                'email' => 'employee@su30.com',
                'password' => Hash::make('employee123'),
                'role_id' => $employeeRole->id,
            ]
        );

        Employee::updateOrCreate(
            ['user_id' => $employeeUser->id],
            [
                'department_id' => $generalDepartment->id,
                'employee_id' => 'EMP-0001',
                'position' => 'Receptionist',
                'hire_date' => now()->subMonths(6)->toDateString(),
                'salary' => '40000',
                'phone' => '081234567891',
            ]
        );

        // Create patient users
        $patientData = [
            [
                'username' => 'patient1',
                'name' => 'John Doe',
                'email' => 'patient1@su30.com',
                'password' => Hash::make('patient123'),
            ],
            [
                'username' => 'patient2',
                'name' => 'Jane Smith',
                'email' => 'patient2@su30.com',
                'password' => Hash::make('patient123'),
            ],
            [
                'username' => 'patient3',
                'name' => 'Alex Johnson',
                'email' => 'patient3@su30.com',
                'password' => Hash::make('patient123'),
            ],
        ];

        $patients = [];

        foreach ($patientData as $data) {
            $user = User::updateOrCreate(
                ['username' => $data['username']],
                array_merge($data, ['role_id' => $patientRole->id])
            );

            $patients[] = Patient::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'age' => '30',
                    'address' => '123 Main Street',
                    'phone' => '08123456789',
                    'blood_type' => 'O+',
                    'medical_history' => 'No major illnesses.',
                    'emergency_contact' => 'Mary Doe - 08123456780',
                ]
            );
        }

        // Create schedules for doctor
        $weekDays = [
            ['day' => 'Monday', 'start_time' => '08:00:00', 'end_time' => '12:00:00'],
            ['day' => 'Wednesday', 'start_time' => '10:00:00', 'end_time' => '15:00:00'],
            ['day' => 'Friday', 'start_time' => '09:00:00', 'end_time' => '14:00:00'],
        ];

        foreach ($weekDays as $scheduleData) {
            Schedule::updateOrCreate(
                ['doctor_id' => $doctor->id, 'day' => $scheduleData['day']],
                array_merge($scheduleData, ['status' => 'active'])
            );
        }

        // Create appointments
        if (! empty($patients)) {
            Appointment::updateOrCreate(
                [
                    'patient_id' => $patients[0]->id,
                    'doctor_id' => $doctor->id,
                    'appointment_date' => now()->addDays(2)->setTime(10, 0)->toDateTimeString(),
                ],
                [
                    'department_id' => $generalDepartment->id,
                    'status' => 'confirmed',
                    'notes' => 'Patient needs routine checkup.',
                    'reason_for_visit' => 'General consultation',
                ]
            );

            Appointment::updateOrCreate(
                [
                    'patient_id' => $patients[1]->id,
                    'doctor_id' => $doctor->id,
                    'appointment_date' => now()->addDays(4)->setTime(14, 0)->toDateTimeString(),
                ],
                [
                    'department_id' => $generalDepartment->id,
                    'status' => 'pending',
                    'notes' => 'Follow-up appointment after medication.',
                    'reason_for_visit' => 'Follow-up visit',
                ]
            );
        }

        // Create invoices and payments
        $invoice = Invoice::updateOrCreate(
            ['invoice_number' => 'INV-1001'],
            [
                'patient_id' => $patients[0]->id,
                'invoice_date' => now()->toDateString(),
                'total_amount' => 150.00,
                'paid_amount' => 150.00,
                'status' => 'paid',
                'description' => 'Consultation fee and medicine charge.',
                'due_date' => now()->addDays(7)->toDateString(),
            ]
        );

        Payment::updateOrCreate(
            ['invoice_id' => $invoice->id, 'reference_number' => 'PAY-1001'],
            [
                'payment_method' => 'cash',
                'amount' => 150.00,
                'payment_date' => now()->toDateString(),
                'status' => 'completed',
            ]
        );

        // Create notifications
        Notification::updateOrCreate(
            ['user_id' => $doctorUser->id, 'title' => 'New Appointment Scheduled'],
            [
                'message' => 'A new appointment has been scheduled with John Doe.',
                'type' => 'info',
                'is_read' => false,
            ]
        );

        Notification::updateOrCreate(
            ['user_id' => $adminUser->id, 'title' => 'System Ready'],
            [
                'message' => 'The test database has been seeded with sample data.',
                'type' => 'success',
                'is_read' => false,
            ]
        );

        // Create messages
        Message::updateOrCreate(
            [
                'sender_id' => $adminUser->id,
                'recipient_id' => $doctorUser->id,
                'message' => 'Welcome on board! Your doctor test account is ready.',
            ],
            ['is_read' => false]
        );

        Message::updateOrCreate(
            [
                'sender_id' => $doctorUser->id,
                'recipient_id' => $adminUser->id,
                'message' => 'Thank you. I am ready to start testing.',
            ],
            ['is_read' => true]
        );
    }
}
