<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

trait HelperTrait
{
    public string $validationPhone = 'regex:/^((\+)?(\d)(\s)?(\()?[0-9]{3}(\))?(\s)?([0-9]{3})(\-)?([0-9]{2})(\-)?([0-9]{2}))$/';
    public string $validationPassword = 'required|confirmed|min:3|max:50';
    public string $validationInteger = 'required|integer';
    public string $validationString = 'required|min:3|max:255';
    public string $validationText = 'required|min:5|max:5000';
    public string $validationCalculator = 'required|integer|min:0|max:50';
    public string $validationSvg = 'mimes:svg|max:10';
    public string $validationJpgAndPng = 'required|mimes:jpg,png|max:2000';
    public string $validationJpg = 'mimes:jpg|max:2000';
    public string $validationPng = 'mimes:png|max:2000';
    public string $validationDate = 'regex:/^(\d{2})\/(\d{2})\/(\d{4})$/';

    public function saveCompleteMessage()
    {
        session()->flash('message', trans('admin.save_complete'));
    }

    public function getRequestValidation()
    {
        return [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email',
            'phone' => $this->validationPhone,
//            'text' => 'max:300',
            'i_agree' => 'required|accepted'
        ];
    }

    private $metas = [
        'meta_description' => ['name' => 'description', 'property' => false],
        'meta_keywords' => ['name' => 'keywords', 'property' => false],
        'meta_twitter_card' => ['name' => 'twitter:card', 'property' => false],
        'meta_twitter_size' => ['name' => 'twitter:size', 'property' => false],
        'meta_twitter_creator' => ['name' => 'twitter:creator', 'property' => false],
        'meta_og_url' => ['name' => false, 'property' => 'og:url'],
        'meta_og_type' => ['name' => false, 'property' => 'og:type'],
        'meta_og_title' => ['name' => false, 'property' => 'og:title'],
        'meta_og_description' => ['name' => false, 'property' => 'og:description'],
        'meta_og_image' => ['name' => false, 'property' => 'og:image'],
        'meta_robots' => ['name' => 'robots', 'property' => false],
        'meta_googlebot' => ['name' => 'googlebot', 'property' => false],
        'meta_google_site_verification' => ['name' => 'google-site-verification', 'property' => false],
    ];

    public function getVideoHref(): string
    {
        return file_get_contents(base_path('public/video_href'));
    }

    public function convertColor($color)
    {
        if (preg_match('/^(hsv\(\d+\, \d+\%\, \d+\%\))$/',$color)) {
            $hsv = explode(',',str_replace(['hsv','(',')','%',' '],'',$color));
            $color = $this->fGetRGB($hsv[0],$hsv[1],$hsv[2]);
        }
        return $color;
    }

    public function convertTime($time)
    {
        $time = explode('/', $time);
        return strtotime($time[1].'/'.$time[0].'/'.$time[2]);
    }

    public function processingFile(Request $request, $field, $path, $newFileName)
    {
//        $fileName = $request->file($field)->getClientOriginalName();
//        $fileName = $request->file($field)->getClientOriginalExtension();
        if ($request->hasFile($field)) $request->file($field)->move(base_path('public/'.$path), $newFileName);
    }

//    private function fGetRGB($iH, $iS, $iV)
//    {
//        if($iH < 0)   $iH = 0;   // Hue:
//        if($iH > 360) $iH = 360; //   0-360
//        if($iS < 0)   $iS = 0;   // Saturation:
//        if($iS > 100) $iS = 100; //   0-100
//        if($iV < 0)   $iV = 0;   // Lightness:
//        if($iV > 100) $iV = 100; //   0-100
//        $dS = $iS/100.0; // Saturation: 0.0-1.0
//        $dV = $iV/100.0; // Lightness:  0.0-1.0
//        $dC = $dV*$dS;   // Chroma:     0.0-1.0
//        $dH = $iH/60.0;  // H-Prime:    0.0-6.0
//        $dT = $dH;       // Temp variable
//        while($dT >= 2.0) $dT -= 2.0; // php modulus does not work with float
//        $dX = $dC*(1-abs($dT-1));     // as used in the Wikipedia link
//        switch(floor($dH)) {
//            case 0:
//                $dR = $dC; $dG = $dX; $dB = 0.0; break;
//            case 1:
//                $dR = $dX; $dG = $dC; $dB = 0.0; break;
//            case 2:
//                $dR = 0.0; $dG = $dC; $dB = $dX; break;
//            case 3:
//                $dR = 0.0; $dG = $dX; $dB = $dC; break;
//            case 4:
//                $dR = $dX; $dG = 0.0; $dB = $dC; break;
//            case 5:
//                $dR = $dC; $dG = 0.0; $dB = $dX; break;
//            default:
//                $dR = 0.0; $dG = 0.0; $dB = 0.0; break;
//        }
//        $dM  = $dV - $dC;
//        $dR += $dM; $dG += $dM; $dB += $dM;
//        $dR *= 255; $dG *= 255; $dB *= 255;
//        return 'rgb('.round($dR).', '.round($dG).', '.round($dB).')';
//    }
}
