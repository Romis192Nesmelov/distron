<?php

namespace App\Http\Controllers;
use App\Models\Accumulator;
use App\Models\AccumulatorParam;
use App\Models\Contact;
use App\Models\News;
use App\Models\Question;
use App\Models\Setting;
use App\Models\Content;
use App\Models\Icon;
use Illuminate\Support\Str;
//use Illuminate\Http\Request;

class StaticController extends Controller
{
    use HelperTrait;

    private array $data;

    public function index()
    {
        $this->data['accumulators'] = Accumulator::where('active',1)->get();
        $this->data['params'] = AccumulatorParam::all();
        $this->data['icons'] = Icon::where('active',1)->get();
        $this->data['news'] = News::where('active',1)->get();
        $this->data['content'] = Content::all();
        $this->data['contacts'] = Contact::all();
        $this->data['faq'] = Question::where('active',1)->get();
        return $this->showView('home');
    }

//    public function changeLang(Request $request)
//    {
//        $this->validate($request, ['lang' => 'required|in:en,ru']);
//        setcookie('lang', $request->input('lang'), time()+(60*60*24*365));
//        return redirect()->back();
//    }

    private function showView($view)
    {
        $menu = ['calculator' => ['scroll' => 'calculator', 'name' => trans('menu.calculator')]];
        $content = Content::all();
        foreach ($content as $k => $item) {
            $slug = Str::slug($item->head);
            $menu[$slug] = ['scroll' => $slug, 'name' => $item->head];

            if (!$k) $menu['advantages'] = ['scroll' => 'advantages', 'name' => trans('menu.advantages')];
            elseif ($k == 1) $menu['news'] = ['scroll' => 'news', 'name' => trans('menu.news')];
        }
        $menu['faq'] = ['scroll' => 'faq', 'name' => trans('menu.faq')];
        $menu['contacts'] = ['scroll' => 'contacts', 'name' => trans('menu.contacts')];

        return view($view,array_merge(
            $this->data, [
                    'metas' => $this->metas,
                    'settings' => Setting::first(),
                    'menu' => $menu,
                ]
            )
        );
    }
}
