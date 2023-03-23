<?php

namespace Database\Seeders;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Content;

class ContentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Content::factory()->count(3)->create();
        $addFields = [
            ['image' => 'bad_to_good.jpg', 'head' => 'О компании'],
            ['image' => 'distron-car.png', 'head' => 'Описание услуг'],
            ['image' => 'batteries.jpg', 'head' => 'Требования к АКБ'],
        ];

        foreach ($addFields as $k => $fields) {
            Content::where('id',$k+1)->update($fields);
        }
    }
}
