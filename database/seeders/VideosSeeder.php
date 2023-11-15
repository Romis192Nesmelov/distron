<?php

namespace Database\Seeders;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Video;

class VideosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'video/distron.mp4',
            'video/distron.ogg',
            'video/distron.webm',
        ];

        foreach ($data as $item) {
            Video::create(['path' => $item]);
        }
    }
}
