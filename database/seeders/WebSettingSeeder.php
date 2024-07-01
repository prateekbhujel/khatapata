<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('web_settings')->insert([
            'name' => 'KhataPata',
            'description' => 'Track your expenses effortlessly with KhataPata.',
            'about_us_description' => 'KhataPata is your ultimate solution for managing personal finances. Track your spending, set budgets, and save more with our intuitive app.',
            'btn_name' => 'Register Now',
            'btn_route' => 'register',
            'website_title' => 'KhataPata - Expense Tracker App',
            'seo_description' => 'KhataPata is the best expense tracker app to manage your personal finances.',
            'seo_keywords' => 'expense tracker, budget planner, personal finance',
            'banner' => '/public/images/banner.jpg',
            'favico' => '/public/images/favico.png',
            'logo' => '/public/images/logo.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
