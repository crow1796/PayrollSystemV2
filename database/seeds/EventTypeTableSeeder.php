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
        	['name' => 'Sunday Workdays', 'slug' => 'sunday-workdays', 'class_value' => 'sunday-workdays', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['name' => 'Special Holiday Workdays', 'slug' => 'special-holiday-workdays', 'class_value' => 'special-holiday-workdays', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['name' => 'Legal Holiday Workdays', 'slug' => 'logal-holiday-workdays', 'class_value' => 'logal-holiday-workdays', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['name' => 'Legal Sunday Workdays', 'slug' => 'legal-sunday-workdays', 'class_value' => 'legal-sunday-workdays', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['name' => 'No Work Legal Holiday', 'slug' => 'no-work-legal-holiday', 'class_value' => 'no-work-legal-holiday', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        	['name' => 'Event', 'slug' => 'event', 'class_value' => 'event', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()]
        ];

        DB::table('event_types')->insert($eventTypes);
    }
}
