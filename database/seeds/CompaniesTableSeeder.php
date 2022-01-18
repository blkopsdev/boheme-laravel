<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'company_name' => 'IQ Script',
            'logo' => 'iqscript_logo.png',
            'main_color' => '#4dd7b7',
            'sub_color' => '#aeebdd',
            'other_color' => '#f44338',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
