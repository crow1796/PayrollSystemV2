<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->delete();

        // $permissions = [
        // 	['slug' => 'view_home', 'name' => 'view_home', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        // 	['slug' => 'view_employees', 'name' => 'view_employees', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        // 	['slug' => 'add_employees', 'name' => 'add_employees', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        //     ['slug' => 'edit_employees', 'name' => 'edit_employees', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        //     ['slug' => 'delete_employees', 'name' => 'delete_employees', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        //     ['slug' => 'view_transactions', 'name' => 'view_transactions', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        //     ['slug' => 'add_transactions', 'name' => 'add_transactions', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        //     ['slug' => 'edit_transactions', 'name' => 'edit_transactions', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        //     ['slug' => 'delete_transactions', 'name' => 'delete_transactions', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        //     ['slug' => 'add_employee_dtrs', 'name' => 'add_employee_dtrs', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        //     ['slug' => 'view_events', 'name' => 'view_events', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        //     ['slug' => 'add_events', 'name' => 'add_events', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        //     ['slug' => 'edit_events', 'name' => 'edit_events', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        //     ['slug' => 'delete_events', 'name' => 'delete_events', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        //     ['slug' => 'view_users', 'name' => 'view_users', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        //     ['slug' => 'add_users', 'name' => 'add_users', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        //     ['slug' => 'edit_users', 'name' => 'edit_users', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        //     ['slug' => 'delete_users', 'name' => 'delete_users', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        //     ['slug' => 'view_logs', 'name' => 'view_logs', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        //     ['slug' => 'delete_logs', 'name' => 'delete_logs', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        // ];

        $permissions = [
            ['slug' => 'administrator', 'name' => 'Administrator', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['slug' => 'payroll-officer', 'name' => 'Payroll Officer', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['slug' => 'manager', 'name' => 'Manager', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['slug' => 'coordinator', 'name' => 'coordinator', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        ];

        DB::table('permissions')->insert($permissions);
    }
}
