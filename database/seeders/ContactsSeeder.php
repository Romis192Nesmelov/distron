<?php

namespace Database\Seeders;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['contact' => 'Адрес: 127422, г.Москва, вн.тер. г.Муниципальный Округ Тимирязевский, ул.Тимирязевская, дом 8, корпус 1, квартира 37', 'type' => 1],
//            ['contact' => '+7(926)333-22-11', 'type' => 2],
//            ['contact' => 'info@distron.ru', 'type' => 3],
            ['contact' => '<iframe id="map" src="https://yandex.ru/map-widget/v1/?um=constructor%3A2e46a7c4af371d2653e709cb2dd429e6e9044779994ccf20fd13224e3919e106&amp;source=constructor" width="100%" height="450" frameborder="0"></iframe>', 'type' => 4],
        ];

        foreach ($data as $item) {
            Contact::create($item);
        }
    }
}
