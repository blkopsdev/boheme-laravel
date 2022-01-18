<?php

use Illuminate\Database\Seeder;

class CalendarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('calendars')->insert(
            [
                [
                    'name' => 'Deadline',
                    'user_id' => 1,
                    'status' => '1',
                    'bg_color' => '#7B68EE',
                    'type' => '1',
                    'created_at' => Now(),
                    'updated_at' => Now()
                ],
                [
                    'name' => 'Completed',
                    'user_id' => 1,
                    'status' => '1',
                    'bg_color' => '#7BC831',
                    'type' => '1',
                    'created_at' => Now(),
                    'updated_at' => Now()
                ]
            ]
        );
    }
}
