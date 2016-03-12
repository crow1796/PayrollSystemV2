<?php

use Illuminate\Database\Seeder;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->delete();
        DB::table('additional_information')->delete();
        DB::table('contact_information')->delete();

        $employees = [
        	[
        		'id' => '2014-F0082',
        		'position_id' => 1,
        		'department_id' => 1,
        		'designation_id' => 1,
        		'business_unit_id' => 1,
        		'first_name' => 'Diday',
        		'middle_name' => 'Undag',
        		'last_name' => 'Lagumbay',
                'slug' => 'diday',
        		'date_employed' => \Carbon\Carbon::now()->format('Y-m-d'),
                'active' => true,
                'email' => 'diday@gmail.com',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
        	],
        	[
        		'id' => '2014-F0092',
        		'position_id' => 2,
        		'department_id' => 1,
        		'designation_id' => 1,
        		'business_unit_id' => 1,
        		'first_name' => 'Jerald',
        		'middle_name' => 'Eng',
        		'last_name' => 'Yacapin',
                'slug' => 'jerald',
        		'date_employed' => \Carbon\Carbon::now()->format('Y-m-d'),
                'active' => true,
                'email' => 'vhon@gmail.com',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
        	],
        	[
        		'id' => '2014-F0089',
        		'position_id' => 1,
        		'department_id' => 1,
        		'designation_id' => 1,
        		'business_unit_id' => 1,
        		'first_name' => 'Joshua',
        		'middle_name' => 'Agagdan',
        		'last_name' => 'Tundag',
                'slug' => 'joshua',
        		'date_employed' => \Carbon\Carbon::now()->format('Y-m-d'),
                'active' => true,
                'email' => 'joshuatundag@gmail.com',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
        	],
        ];

        $additional_information = [
            [
                'employee_id' => '2014-F0082',
                'date_of_birth' => \Carbon\Carbon::now()->format('Y-m-d'),
                'place_of_birth' => 'Gate',
                'weight' => 100,
                'height' => 100,
                'religion' => 'Muslim',
                'civil_status' => 'Single',
                'gender' => 'Female',
                'educational_attainment' => 'Doctorate',
                'course' => 'Kagebunshin Jutsu',
                'mother_name' => 'Hinata',
                'father_name' => 'Naruto',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'employee_id' => '2014-F0092',
                'date_of_birth' => \Carbon\Carbon::now()->format('Y-m-d'),
                'place_of_birth' => 'City Z',
                'weight' => 100,
                'height' => 100,
                'religion' => 'Chinese',
                'civil_status' => 'Single',
                'gender' => 'Male',
                'educational_attainment' => 'Doctorate',
                'course' => 'Rasengan',
                'mother_name' => 'Kiyoko',
                'father_name' => 'Genos',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'employee_id' => '2014-F0089',
                'date_of_birth' => \Carbon\Carbon::now()->format('Y-m-d'),
                'place_of_birth' => 'Konoha',
                'weight' => 100,
                'height' => 100,
                'religion' => 'Catholic',
                'civil_status' => 'Single',
                'gender' => 'Male',
                'educational_attainment' => 'Doctorate',
                'course' => 'Serious Series Punch',
                'mother_name' => 'Chitoge',
                'father_name' => 'Saitama',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        ];
        $contact_information = [
            [
                'employee_id' => '2014-F0082',
                'mobile_number' => '156123540',
                'telephone_number' => '1234123',
                'emergency_name' => 'Hinata',
                'emergency_name' => '1',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'employee_id' => '2014-F0092',
                'mobile_number' => '45123312',
                'telephone_number' => '8254142',
                'emergency_name' => 'Genos',
                'emergency_name' => '1',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
            [
                'employee_id' => '2014-F0089',
                'mobile_number' => '52811253',
                'telephone_number' => '9182541',
                'emergency_name' => 'Saitama',
                'emergency_name' => '1',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        ];

        DB::table('employees')->insert($employees);
        DB::table('additional_information')->insert($additional_information);
        DB::table('contact_information')->insert($contact_information);
    }
}
