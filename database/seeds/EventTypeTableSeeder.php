<?php

use Illuminate\Database\Seeder;

class EventTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('event_types')->delete();

        $eventTypes = [
            ['name' => 'Special Holiday Workday', 'slug' => 'special-holiday-workday', 'class_value' => 'special-holiday-workday', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['name' => 'Legal Holiday Workday', 'slug' => 'logal-holiday-workday', 'class_value' => 'logal-holiday-workday', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['name' => 'Legal Sunday Workday', 'slug' => 'legal-sunday-workday', 'class_value' => 'legal-sunday-workday', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['name' => 'No Work Legal Holiday', 'slug' => 'no-work-legal-holiday', 'class_value' => 'no-work-legal-holiday', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        	['name' => 'Event', 'slug' => 'event', 'class_value' => 'event', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()]
        ];

        DB::table('event_types')->insert($eventTypes);
    }
}
