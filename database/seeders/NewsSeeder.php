<?php

namespace Database\Seeders;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['time' => strtotime("11 April 2023"), 'head' => 'Компания «Дистрон» примет участие в выставке «Автономные источники тока»', 'text' => '<p>Компания «Дистрон» примет участие в Международной специализированной выставке «Автономные источники тока» (10-11 апреля 2023 г.). Наша технология будет представлена лидерам производства аккумуляторных батарей и их пользователей.</p><p><a href="https://www.rusbat-expo.com/home" target="_blank">https://www.rusbat-expo.com/home</a></p>'],
            ['time' => strtotime("12 April 2023"), 'head' => 'Компания «Battery Solution International Ltd.» подписала соглашение с Shanghai CHN-ISR', 'text' => '<p>Компания «Battery Solution International Ltd.» подписала ивестиционное партнерское соглашение с 上海中以投资发展有限公司 Shanghai CHN-ISR. Теперь наша технология получила применение во всех крупнейших странах мира.</p><p><a href="https://www.bsi-intr.com/page_13821" target="_blank">https://www.bsi-intr.com/page_13821</a></p>'],
            ['time' => strtotime("13 April 2023"), 'head' => 'ООО «Sakuraz Green Energy» получила стартап-сертификат.', 'text' => '<p>Применение технологии BSI в Азербайджане было высоко оценено не только компаниями-потребителями, но и на государственном уровне. Недавно наша партнерская компания ООО «Sakuraz Green Energy» получила стартап-сертификат.</p><p><a href="https://report.az/ru/biznes/v-azerbajdzhane-eshe-tri-subekta-msb-poluchili-startap-sertifikaty/" target="_blank">https://report.az/ru/biznes/v-azerbajdzhane-eshe-tri-subekta-msb-poluchili-startap-sertifikaty</a></p>'],
        ];

        foreach ($data as $item) {
            $item['active'] = 1;
            News::create($item);
        }
    }
}
