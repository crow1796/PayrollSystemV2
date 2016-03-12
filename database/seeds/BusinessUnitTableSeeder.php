<?php

use Illuminate\Database\Seeder;

class BusinessUnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('business_units')->delete();

        $businessUnits = [
        	[
                'name' => 'BMPC CDO',
                'slug' => 'bmpc-cdo',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]
        ];

        DB::table('business_units')->insert($businessUnits);
    }
}
