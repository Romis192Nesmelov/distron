<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(IconsSeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(ContentsSeeder::class);
        $this->call(QuestionsSeeder::class);
        $this->call(ContactsSeeder::class);
        $this->call(MetricsSeeder::class);
    }
}
