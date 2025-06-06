<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create some specific tasks for testing
        Task::create([
            'name' => 'Complete project documentation',
            'description' => 'Write comprehensive documentation for the new API endpoints',
            'staff_id' => 1, // Assign to first staff member
            'assigned_by' => 2, // Assigned by second staff member
            'due_date' => now()->addDays(7)->format('Y-m-d'),
            'status' => 'in_progress',
            'priority' => 'high'
        ]);

        Task::create([
            'name' => 'Fix login page bug',
            'description' => 'Users reporting 500 error when attempting to login',
            'staff_id' => 2,
            'assigned_by' => 1,
            'due_date' => now()->addDays(2)->format('Y-m-d'),
            'status' => 'pending',
            'priority' => 'high'
        ]);

        // Create random tasks
        Task::factory()->count(30)->create();
    }
}
