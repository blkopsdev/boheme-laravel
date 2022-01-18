<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert(
            [
                [
                    'name' => 'Logo onboarding',
                    'slug'  => 'logo_design',
                    'model' => 'App\LogoDesignForm',
                    'file_attachment' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Logo versie 1',
                    'slug'  => 'logo_version_1',
                    'model' => 'App\LogoFirstFeedback',
                    'file_attachment' => '1',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Logo versie 2',
                    'slug'  => 'logo_version_2',
                    'model' => 'App\LogoFinalFeedback',
                    'file_attachment' => '1',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Logo afgerond',
                    'slug'  => 'logo_completed',
                    'model' => 'App\LogoCompleted',
                    'file_attachment' => '1',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Webdesign onboarding',
                    'slug'  => 'web_design',
                    'model' => 'App\WebDesign',
                    'file_attachment' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Webdesign onboarding',
                    'slug'  => 'webdesign_onboarding',
                    'model' => 'App\WebdesignOnboarding',
                    'file_attachment' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Webdesign versie 1',
                    'slug'  => 'webdesign_version_1',
                    'model' => 'App\WebdesignFirstVersion',
                    'file_attachment' => '1',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Webdesign versie 2',
                    'slug'  => 'webdesign_version_2',
                    'model' => 'App\WebdesignFinalVersion',
                    'file_attachment' => '1',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Webdesign afgerond',
                    'slug'  => 'webdesign_completed',
                    'model' => 'App\WebdesignCompleted',
                    'file_attachment' => '1',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Tekst schrijven',
                    'slug'  => 'text_writing',
                    'model' => 'App\TextWriting',
                    'file_attachment' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Tekst versie 1',
                    'slug'  => 'text_version_1',
                    'model' => 'App\TextFirstFeedback',
                    'file_attachment' => '1',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Tekst versie 2',
                    'slug'  => 'text_version_2',
                    'model' => 'App\TextFinalFeedback',
                    'file_attachment' => '1',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Tekst afgerond',
                    'slug'  => 'text_completed',
                    'model' => 'App\TextCompleted',
                    'file_attachment' => '1',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Webdesign development',
                    'slug'  => 'webdesign_dev',
                    'model' => 'App\WebdesignDev',
                    'file_attachment' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Eerste versie homepage',
                    'slug'  => 'first_home',
                    'model' => 'App\FirstHome',
                    'file_attachment' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Website onboarding',
                    'slug'  => 'onboarding',
                    'model' => 'App\Onboarding',
                    'file_attachment' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Content toevoegen',
                    'slug'  => 'text_adding',
                    'model' => 'App\WebsiteTextAdding',
                    'file_attachment' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Webshop onboarding',
                    'slug'  => 'webshop_onboarding',
                    'model' => 'App\WebshopOnboarding',
                    'file_attachment' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Content toevoegen',
                    'slug'  => 'content_adding',
                    'model' => 'App\ContentAdding',
                    'file_attachment' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Eerste feedback',
                    'slug'  => 'first_feedback',
                    'model' => 'App\FirstFeedback',
                    'file_attachment' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Extra functionaliteiten',
                    'slug'  => 'extra_function',
                    'model' => 'App\ExtraFunction',
                    'file_attachment' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Final feedback',
                    'slug'  => 'final_feedback',
                    'model' => 'App\FinalFeedback',
                    'file_attachment' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Hosting',
                    'slug'  => 'hosting',
                    'model' => 'App\Hosting',
                    'file_attachment' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Afgerond',
                    'slug'  => 'afgerond',
                    'model' => '',
                    'file_attachment' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'name' => 'Review',
                    'slug'  => 'review',
                    'model' => '',
                    'file_attachment' => '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]
        );
    }
}
