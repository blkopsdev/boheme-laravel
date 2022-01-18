<?php

use Illuminate\Database\Seeder;

class ErrorMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('error_messages')->insert(
            [
                [
                    'message'   => 'Logo formaat',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'message'   => 'Foto\'s formaat',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'message'   => 'Geen reactie klant',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'message'   => 'Wordpress inlog',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'message'   => 'Hosting inlog',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'message'   => 'Extra werkzaamheden',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'message'   => 'Foto\'s aanleveren',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'message'   => 'Zakelijke mail instellen',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'message'   => 'Mail verstuurd niet',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'message'   => 'Feedback logo',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'message'   => 'Feedback text',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'message'   => 'Website Feedback',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]
        );
    }
}
