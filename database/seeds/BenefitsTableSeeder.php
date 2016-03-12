<?php

use Illuminate\Database\Seeder;

class BenefitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('benefits')->delete();

        $benefits = [
        	[
                'name' => 'SSS',
                'slug' => 'sss',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
        	[
                'name' => 'PAGIBIG',
                'slug' => 'pagibig',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ],
        	[
                'name' => 'PhilHealth',
                'slug' => 'philhealth',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        ];

        DB::table('benefits')->insert($benefits);
    }
}
