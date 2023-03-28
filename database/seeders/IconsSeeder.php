<?php

namespace Database\Seeders;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Icon;

class IconsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Значительно продление жизненного цикла АКБ',
            'Защита окружающей среды, «зеленые» технологии',
            'Экономическая выгода, экономия средств',
            'Гарантия до 3 лет на восстановленные элементы'
        ];

        foreach ($data as $title) {
            $item = [
                'title' => $title,
                'active' => 1
            ];
            Icon::create($item);
        }
    }
}
