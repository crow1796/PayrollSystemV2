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
        	['name' => 'Regular Holiday', 'slug' => 'regular-holiday', 'class_value' => 'regular-holiday', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['name' => 'Special Non-working Holiday', 'slug' => 'special-non-working-holiday', 'class_value' => 'special-non-working-holiday', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['name' => 'Observance', 'slug' => 'observance', 'class_value' => 'observance', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['name' => 'Common Local Holiday', 'slug' => 'common-local-holiday', 'class_value' => 'common-local-holiday', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['name' => 'Muslim, Common Local Holiday', 'slug' => 'muslim-common-local-holiday', 'class_value' => 'muslim-common-local-holiday', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
            ['name' => 'Season', 'slug' => 'season', 'class_value' => 'season', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()],
        	['name' => 'Event', 'slug' => 'event', 'class_value' => 'event', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()]
        ];

        DB::table('event_types')->insert($eventTypes);
    }
}
