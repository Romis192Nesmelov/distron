<?php

namespace Database\Seeders;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AccumulatorParam;

class AccumulatorParamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['type' => 0, 'min' => 5, 'max' => 12],
            ['type' => 1, 'min' => 1, 'max' => 6],
        ];

        foreach ($data as $item) {
            AccumulatorParam::create($item);
        }
    }
}
