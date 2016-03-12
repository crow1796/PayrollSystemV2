<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserTableSeeder::class);
        $this->call(DepartmentTableSeeder::class);
        $this->call(PositionTableSeeder::class);
        $this->call(DesignationTableSeeder::class);
        $this->call(BusinessUnitTableSeeder::class);
        $this->call(BenefitsTableSeeder::class);
        $this->call(EmployeeTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(EventTypeTableSeeder::class);
        $this->call(EventTableSeeder::class);
    }
}
