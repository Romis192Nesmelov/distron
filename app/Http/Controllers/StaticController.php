<?php

namespace App\Http\Controllers;
use App\Models\Question;
use App\Models\Setting;
use App\Models\Content;
use App\Models\Icon;
//use Illuminate\Http\Request;

class StaticController extends Controller
{
    use HelperTrait;

    public function index1()
    {
        return $this->showView('home1');
    }

    public function index2()
    {
        return $this->showView('home2');
    }

//    public function changeLang(Request $request)
//    {
//        $this->validate($request, ['lang' => 'required|in:en,ru']);
//        setcookie('lang', $request->input('lang'), time()+(60*60*24*365));
//        return redirect()->back();
//    }

    private function showView($view)
    {
        return view($view,[
            'metas' => $this->metas,
            'settings' => Setting::first(),
            'menu' => [
                'calculator' =>             ['scroll' => 'calculator', 'name' => trans('menu.calculator')],
                'about_company' =>          ['scroll' => 'about_company', 'name' => trans('menu.about_company')],
                'advantages' =>             ['scroll' => 'advantages', 'name' => trans('menu.advantages')],
                'our_services' =>           ['scroll' => 'our_services', 'name' => trans('menu.our_services')],
                'battery_requirements' =>   ['scroll' => 'battery_requirements', 'name' => trans('menu.battery_requirements')],
                'faq' =>                    ['scroll' => 'faq', 'name' => trans('menu.faq')],
                'contacts' =>               ['scroll' => 'contacts', 'name' => trans('menu.contacts')]
            ],
            'icons' => Icon::where('active',1)->get(),
            'content' => Content::all(),
            'faq' => Question::where('active',1)->get()
        ]);
    }
}
