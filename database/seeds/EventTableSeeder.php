<?php

use Illuminate\Database\Seeder;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->delete();

        $events = [
        	['title' => 'Regular Holiday', 'slug' => 'regular-holiday', 'event_type_id' => 1, 'allDay' => 1, 'start' => \Carbon\Carbon::parse('Feb 21, 2016'), 'description' => 'Sample Regular Holiday', 'className' => 'regular-holiday', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        	['title' => 'Special Non-Working Holiday', 'slug' => 'special-non-working-holiday', 'event_type_id' => 2, 'allDay' => 1, 'start' => \Carbon\Carbon::parse('Feb 22, 2016'), 'description' => 'Sample Special Non-working Holiday', 'className' => 'special-non-working-holiday', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        	['title' => 'Observance', 'slug' => 'observance', 'event_type_id' => 3, 'allDay' => 1, 'start' => \Carbon\Carbon::parse('Feb 23, 2016'), 'description' => 'Sample Observance', 'className' => 'observance', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        	['title' => 'Common Local Holiday', 'slug' => 'common-local-holiday', 'event_type_id' => 4, 'allDay' => 1, 'start' => \Carbon\Carbon::parse('Feb 24, 2016'), 'description' => 'Sample Common Local Holiday', 'className' => 'common-local-holiday', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        	['title' => 'Muslim, Common Local Holiday', 'slug' => 'muslim-common-local-holiday', 'event_type_id' => 5, 'allDay' => 1, 'start' => \Carbon\Carbon::parse('Feb 25, 2016'), 'description' => 'Sample Muslim, Common Local Holiday', 'className' => 'muslim-common-local-holiday', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        	['title' => 'Season', 'slug' => 'season', 'event_type_id' => 6, 'allDay' => 1, 'start' => \Carbon\Carbon::parse('Feb 26, 2016'), 'description' => 'Sample Season', 'className' => 'season', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        	['title' => 'Event', 'slug' => 'event', 'event_type_id' => 7, 'allDay' => 1, 'start' => \Carbon\Carbon::parse('Feb 27, 2016'), 'description' => 'Sample Event', 'className' => 'event', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        ];

        DB::table('events')->insert($events);
    }
}
