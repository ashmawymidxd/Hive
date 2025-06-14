<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create predefined essential roles
        Role::create([
            'name' => 'Super Admin',
            'access_level' => 'admin',
            'permissions' => json_encode([
                'manage_rooms',
                'view_amenities',
                'create_amenities',
                'update_amenities',
                'delete_amenities',
                'view_room_details',
                'upload_room_images',
                'delete_room_images',
                'manage_reservations',
                'reservation_check_in',
                'reservation_check_out',
                'reservation_no_show',
                'manage_guests',
                'search_guests',
                'view_notifications',
                'mark_notification_read',
                'mark_all_notifications_read',
                'create_feedback',
                'view_feedback',
                'update_feedback',
                'add_blacklist',
                'update_blacklist_status',
                'manage_staff',
                'update_staff_password',
                'view_roles',
                'create_role',
                'update_role',
                'delete_role',
                'manage_departments',
                'assign_tasks',
                'view_task',
                'update_task',
                'delete_task',
                'view_inventory',
                'manage_inventory',
                'manage_housekeeping',
                'view_housekeeping_alerts',
                'update_housekeeping_reorder',
                'manage_vendors',
                'manage_invoices',
                'download_invoice',
                'print_invoice',
                'mark_invoice_paid',
                'manage_payments',
            ])
        ]);

        Role::create([
            'name' => 'Department Manager',
            'access_level' => 'manager',
            'permissions' => json_encode(['manage_department', 'view_reports', 'approve_requests'])
        ]);

        Role::create([
            'name' => 'Team Member',
            'access_level' => 'staff',
            'permissions' => json_encode(['view_tasks', 'submit_reports'])
        ]);

        // Create additional random roles using the factory
        Role::factory()->count(5)->create();
    }
}
