<?php

namespace App\Http\Controllers;
use App\Models\Accumulator;
use App\Models\AccumulatorParam;
use App\Models\Contact;
use App\Models\Icon;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Setting;
use App\Models\Content;
//use Illuminate\Support\Str;

class AdminController extends Controller
{
    use HelperTrait;

    private array $data = [];
    private array $breadcrumbs = [];
    private array $menu;

    public function __construct()
    {
        $this->menu = [
            'home' => [
                'id' => 'home',
                'href' => 'admin.home',
                'name' => trans('admin_menu.home'),
                'description' => '',
                'icon' => 'icon-home2',
            ],
            'users' => [
                'id' => 'users',
                'href' => 'admin.users',
                'name' => trans('admin_menu.admins'),
                'description' => trans('admin_menu.admins_description'),
                'icon' => 'icon-users',
            ],
            'settings' => [
                'id' => 'settings',
                'href' => 'admin.settings',
                'name' => trans('admin_menu.settings'),
                'description' => trans('admin_menu.settings_description'),
                'icon' => 'icon-gear',
            ],
            'accumulators' => [
                'id' => 'accumulators',
                'href' => 'admin.accumulators',
                'name' => trans('admin_menu.accumulators'),
                'description' => trans('admin_menu.accumulators_description'),
                'icon' => 'icon-battery-charging',
            ],
            'calculator' => [
                'id' => 'calculator',
                'href' => 'admin.calculator',
                'name' => trans('admin_menu.calculator'),
                'description' => trans('admin_menu.calculator_description'),
                'icon' => 'icon-equalizer',
            ],
            'icons' => [
                'id' => 'icons',
                'href' => 'admin.icons',
                'name' => trans('admin_menu.icons'),
                'description' => trans('admin_menu.icons_description'),
                'icon' => 'icon-people',
            ],
            'content' => [
                'id' => 'content',
                'href' => 'admin.contents',
                'name' => trans('admin_menu.content'),
                'description' => trans('admin_menu.content_description'),
                'icon' => 'icon-puzzle2',
            ],
            'faq' => [
                'id' => 'faq',
                'href' => 'admin.faq',
                'name' => trans('admin_menu.faq'),
                'description' => trans('admin_menu.faq_description'),
                'icon' => 'icon-question3',
            ],
            'contacts' => [
                'id' => 'contacts',
                'href' => 'admin.contacts',
                'name' => trans('admin_menu.contacts'),
                'description' => trans('admin_menu.contacts_description'),
                'icon' => 'icon-map',
            ],
        ];
        $this->breadcrumbs[] = $this->menu['home'];
    }

    public function home()
    {
        return $this->showView('home');
    }

    public function users(Request $request, $slug=null)
    {
        $this->data['menu_key'] = 'users';
        $this->breadcrumbs[] = $this->menu['users'];
        if ($request->has('id')) {
            $this->data['user'] = User::findOrFail($request->input('id'));
            $this->breadcrumbs[] = [
                'id' => $this->menu['users']['id'],
                'href' => $this->menu['users']['href'],
                'params' => ['id' => $this->data['user']->id],
                'name' => trans('admin.edit_user', ['user' => $this->data['user']->email]),
            ];
            return $this->showView('user');
        } else if ($slug && $slug == 'add') {
            $this->breadcrumbs[] = [
                'id' => $this->menu['users']['id'],
                'href' => $this->menu['users']['href'],
                'slug' => 'add',
                'name' => trans('admin.adding_user'),
            ];
            return $this->showView('user');
        } else {
            $this->data['users'] = User::all();
            return $this->showView('users');
        }
    }

    public function editUser(Request $request)
    {
        $validationArr = ['email' => 'required|email|unique:users,email'];
        if ($request->has('id')) {
            $validationArr['id'] = 'required|integer|exists:users,id';
            $validationArr['email'] .= ','.$request->input('id');
            if ($request->input('password')) $validationArr['password'] = $this->validationPassword;
            $fields = $this->validate($request, $validationArr);
            $user = User::find($request->input('id'));
            if ($request->input('password')) $fields['password'] = bcrypt($fields['password']);
            $user->update($fields);
        } else {
            $validationArr['password'] = $this->validationPassword;
            $fields = $this->validate($request, $validationArr);
            $fields['password'] = bcrypt($fields['password']);
            User::create($fields);
        }
        $this->saveCompleteMessage();
        return redirect(route('admin.users'));
    }

    public function deleteUser(Request $request)
    {
        return $this->deleteSomething($request, new User());
    }

    public function settings()
    {
        $this->breadcrumbs[] = $this->menu['settings'];
        $this->data['metas'] = $this->metas;
        $this->data['settings'] = Setting::find(1);
        return $this->showView('settings');
    }

    public function accumulators(Request $request, $slug=null)
    {
        return $this->getSomething(
            $request,
            new Accumulator(),
            'accumulators',
            'accumulators',
            $slug,
            'admin.edit_accumulator',
            'admin.adding_accumulator',
            'accumulators',
            'accumulator'
        );
    }

    public function editAccumulator(Request $request)
    {
        return $this->editSometing (
            $request,
            new Accumulator(),
            ['name' => $this->validationString],
            $this->validationPng,
            '',
            '',
            'accumulators'
        );
    }

    public function calculator(Request $request, $slug=null)
    {
        return $this->getSomething(
            $request,
            new AccumulatorParam(),
            'calculator',
            'params',
            null,
            'admin.edit_calculator',
            '',
            'calculator',
            ''
        );
    }

    public function editCalculator(Request $request)
    {
        $fields = $this->validate($request, [
            'voltage_from' => $this->validationCalculator,
            'voltage_to' => $this->validationCalculator,
            'resistance_from' => $this->validationCalculator,
            'resistance_to' => $this->validationCalculator,
        ]);

        $params = AccumulatorParam::all();
        $params[0]->update([
            'min' => $fields['voltage_from'],
            'max' => $fields['voltage_to']
        ]);

        $params[1]->update([
            'min' => $fields['resistance_from'],
            'max' => $fields['resistance_to']
        ]);
        $this->saveCompleteMessage();
        return redirect(route('admin.calculator'));
    }

    public function deleteAccumulator(Request $request)
    {
        return $this->deleteSomething($request, new Accumulator());
    }

    public function editSettings(Request $request)
    {
        $validationArr = ['title' => $this->validationString];

        foreach ($this->metas as $meta => $params) {
            if ($request->has($meta) && $request->input($meta)) {
                $validationArr[$meta] = $this->validationString;
            }
        }
        $fields = $this->validate($request, $validationArr);
        $settings = Setting::find(1);
        $settings->update($fields);
        $this->saveCompleteMessage();
        return redirect(route('admin.settings'));
    }

    public function icons(Request $request, $slug=null)
    {
        return $this->getSomething(
            $request,
            new Icon(),
            'icons',
            'icons',
            null,
            'admin.edit_icon',
            'admin.adding_icon',
            'icons',
            'icon'
        );
    }

    public function editicon(Request $request)
    {
        return $this->editSometing (
            $request,
            new Icon,
            ['title' => $this->validationString],
            $this->validationPng,
            'images/icons/',
            'icon%id%.png',
            'icons'
        );
    }

    public function deleteicon(Request $request)
    {
        return $this->deleteSomething($request, new Icon());
    }

    public function contents(Request $request)
    {
        return $this->getSomething(
            $request,new Content(),
            'content',
            'contents',
            null,
            'admin.edit_content',
            '',
            'contents',
            'content'
        );
    }

    public function editContent(Request $request)
    {
        $validationArr = [
            'head' => $this->validationString,
            'text' => $this->validationText
        ];

        return $this->editSometing (
            $request,
            new Content(),
            $validationArr,
            $this->validationJpgAndPng,
            'images/contents/',
            '',
            'contents'
        );
    }

    public function faq(Request $request, $slug=null)
    {
        return $this->getSomething(
            $request,
            new Question(),
            'faq',
            'questions',
            $slug,
            'admin.edit_question',
            'admin.adding_question',
            'questions',
            'question'
        );
    }

    public function editFaq(Request $request)
    {
        $validationArr = [
            'question' => $this->validationString,
            'answer' => $this->validationText
        ];

        return $this->editSometing (
            $request,
            new Question(),
            $validationArr,
            '',
            '',
            '',
            'faq'
        );
    }

    public function deleteFaq(Request $request)
    {
        return $this->deleteSomething($request, new Question());
    }

    public function contacts(Request $request, $slug=null)
    {
        return $this->getSomething(
            $request,
            new Contact(),
            'contacts',
            'contacts',
            $slug,
            'admin.edit_contact',
            'admin.adding_contact',
            'contacts',
            'contact'
        );
    }

    public function editContact(Request $request)
    {
        $validationArr = [
            'contact' => $this->validationString,
            'type' => 'required|integer|min:1|max:4'
        ];

        return $this->editSometing (
            $request,
            new Contact(),
            $validationArr,
            '',
            '',
            '',
            'contacts'
        );
    }

    public function deleteContact(Request $request)
    {
        return $this->deleteSomething($request, new Contact());
    }

    private function getSomething (
        Request $request,
        Model $model,
        string $menuKey,
        string $itemName,
        string $slug = null,
        string $editNameTitle,
        string $addNameTitle,
        string $viewForList,
        string $viewForOne
    )
    {
        $this->data['menu_key'] = $menuKey;
        $this->breadcrumbs[] = $this->menu[$menuKey];
        if ($request->has('id')) {
            $itemName = substr($itemName, 0, -1);
            $this->data[$itemName] = $model->find($request->input('id'));
            $this->breadcrumbs[] = [
                'id' => $this->menu[$menuKey]['id'],
                'href' => $this->menu[$menuKey]['href'],
                'params' => ['id' => $this->data[$itemName]->id],
                'name' => trans($editNameTitle, ['id' => $this->data[$itemName]->id]),
            ];
            return $this->showView($viewForOne);
        } else if ($slug && $slug == 'add') {
            $this->breadcrumbs[] = [
                'id' => $this->menu[$menuKey]['id'],
                'href' => $this->menu[$menuKey]['href'],
                'slug' => 'add',
                'name' => trans($addNameTitle),
            ];
            return $this->showView($viewForOne);
        } else {
            $this->data[$itemName] = $model->all();
            return $this->showView($viewForList);
        }
    }

    private function editSometing (
        Request $request,
        Model $model,
        array $validationArr,
        string $validationImage,
        string $pathToImages,
        string $imageName,
        string $returnRoute
    )
    {
        if ($request->has('id')) {
            $validationArr['id'] = 'required|integer|exists:'.$model->getTable().',id';

            if ($validationImage && $request->hasFile('image')) $validationArr['image'] = $validationImage;
            $fields = $this->validate($request, $validationArr);
            $fields['active'] = isset($request->active) && $request->active ? 1 : 0;
//            if (isset($fields['time'])) $fields['time'] = $this->convertTime($fields['time']);

            $table = $model->find($request->input('id'));
            $table->update($fields);
        } else {
            if ($validationImage) $validationArr['image'] = 'required|'.$validationImage;
            $fields = $this->validate($request, $validationArr);
            $fields['active'] = $request->active ? 1 : 0;
//            if (isset($fields['time'])) $fields['time'] = $this->convertTime($fields['time']);

            $table = $model->create($fields);
        }

        if ($validationImage && $request->hasFile('image')) {

            if ($model instanceof Content) {
                $imageName = $request->file('image')->getClientOriginalName();
                $table->image = $imageName;
                $table->save();
            } else $imageName = str_replace('%id%',$table->id,$imageName);
            $this->processingFile($request,'image',$pathToImages,$imageName);
        }
        $this->saveCompleteMessage();
        return redirect(route('admin.'.$returnRoute));
    }

    private function deleteSomething(Request $request, Model $model)
    {
        $this->validate($request, ['id' => 'required|integer|exists:'.$model->getTable().',id']);
        $table = $model->find($request->input('id'));

        if ($model instanceof Icon) {
            unlink(base_path('public/images/icons/icon'.$table->id.'.png'));
        } elseif (isset($table->image) && $model->image && file_exists(base_path('public/'.$model->image))) {
            unlink(base_path('public/'.$model->image));
        } elseif (isset($table->images)) {
            foreach ($table->images as $image) {
                if (file_exists(base_path('public/'.$image->preview))) unlink(base_path('public/'.$image->preview));
                if (file_exists(base_path('public/'.$image->full))) unlink(base_path('public/'.$image->full));
            }
        }

        $table->delete();
        return response()->json(['success' => true]);
    }

    private function showView($view)
    {
        return view('admin.'.$view, [
            'breadcrumbs' => $this->breadcrumbs,
            'data' => $this->data,
            'menu' => $this->menu
        ]);
    }
}
