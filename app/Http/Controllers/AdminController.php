<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use App\Models\Icon;
use App\Models\News;
use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Setting;
use App\Models\Content;
use App\Models\Metric;
use App\Models\Video;
use Illuminate\View\View;

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
            'videos' => [
                'id' => 'videos',
                'href' => 'admin.videos',
                'name' => trans('admin_menu.video'),
                'description' => trans('admin_menu.video_description'),
                'icon' => 'icon-gear',
            ],
            'icons' => [
                'id' => 'icons',
                'href' => 'admin.icons',
                'name' => trans('admin_menu.icons'),
                'description' => trans('admin_menu.icons_description'),
                'icon' => 'icon-people',
            ],
            'news' => [
                'id' => 'news',
                'href' => 'admin.news',
                'name' => trans('admin_menu.news'),
                'description' => trans('admin_menu.news_description'),
                'icon' => 'icon-newspaper',
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
            'metrics' => [
                'id' => 'metrics',
                'href' => 'admin.metrics',
                'name' => trans('admin_menu.metrics'),
                'description' => trans('admin_menu.metrics_description'),
                'icon' => 'icon-code',
            ],
        ];
        $this->breadcrumbs[] = $this->menu['home'];
    }

    public function home(): View
    {
        return $this->showView('home');
    }

    public function users(Request $request, $slug=null): View
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

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editUser(Request $request): RedirectResponse
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

    public function deleteUser(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new User());
    }

    public function settings(): View
    {
        $this->breadcrumbs[] = $this->menu['settings'];
        $this->data['metas'] = $this->metas;
        $this->data['settings'] = Setting::find(1);
        return $this->showView('settings');
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editSettings(Request $request): RedirectResponse
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

    public function videos(Request $request, $slug=null): View
    {
        $this->data['video_href'] = $this->getVideoHref();
        return $this->getSomething(
            $request,
            new Video(),
            'videos',
            'videos',
            'admin.edit_video',
            'admin.adding_video',
            'videos',
            'video',
            $slug
        );
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editVideoHref(Request $request): RedirectResponse
    {
        $this->validate($request, ['href' => $this->validationString]);
        file_put_contents(base_path('public/video_href'), $request->href);
        $this->saveCompleteMessage();
        return redirect(route('admin.videos'));
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editVideoPoster(Request $request): RedirectResponse
    {
        $this->validate($request, ['poster' => 'required|'.$this->validationJpg]);
        $this->processingFile($request,'poster', 'images/', 'distron.jpg');
        $this->saveCompleteMessage();
        return redirect(route('admin.videos'));
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editVideo(Request $request): RedirectResponse
    {
        $this->validate($request, ['video' => 'required|mimes:mp4,ogg,webm']);
        $newFileName = 'distron.'.$request->file('video')->getClientOriginalExtension();
        if (!file_exists(base_path('public/video/'.$newFileName))) Video::create(['path' => 'video/'.$newFileName]);
        $this->processingFile($request,'video', 'video/', $newFileName);
        $this->saveCompleteMessage();
        return redirect(route('admin.videos'));
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function deleteVideo(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new Video());
    }

    public function icons(Request $request, $slug=null): View
    {
        return $this->getSomething(
            $request,
            new Icon(),
            'icons',
            'icons',
            'admin.edit_icon',
            'admin.adding_icon',
            'icons',
            'icon',
            $slug
        );
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editIcon(Request $request): RedirectResponse
    {
        $icon = $this->editSomething (
            $request,
            new Icon,
            [
                'title' => $this->validationString,
                'image' => $request->has('id') ? $this->validationSvg : 'required|'.$this->validationSvg
            ],
        );
        $this->processingFile($request,'image', 'images/icons/', 'icon'.$icon->id.'.svg');
        return redirect(route('admin.icons'));
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function deleteIcon(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new Icon());
    }

    public function news(Request $request, $slug=null): View
    {
        return $this->getSomething(
            $request,
            new News(),
            'news',
            'news',
            'admin.edit_news',
            'admin.adding_news',
            'all_news',
            'current_news',
            $slug
        );
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editNews(Request $request): RedirectResponse
    {
        $news = $this->editSomething (
            $request,
            new News,
            [
                'time' => $this->validationDate,
                'head' => $this->validationString,
                'text' => $this->validationText,
                'image' => $request->has('id') ? $this->validationJpg : 'required|'.$this->validationJpg
            ]
        );
        $this->processingFile($request,'image', 'images/news/', 'news'.$news->id.'.jpg');
        return redirect(route('admin.news'));
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function deleteNews(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new News());
    }

    public function contents(Request $request): View
    {
        return $this->getSomething(
            $request,new Content(),
            'content',
            'contents',
            'admin.edit_content',
            '',
            'contents',
            'content'
        );
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editContent(Request $request): RedirectResponse
    {
        $validationArr = [];
        for ($i=0;$i<3;$i++) {
            if ($request->has('preview'.$i)) $validationArr['preview'.$i] = $this->validationJpgAndPng;
            if ($request->has('full'.$i)) $validationArr['full'.$i] = $this->validationJpgAndPng;
        }

        $content = $this->editSomething (
            $request,
            new Content(),
            array_merge(
                $validationArr,
                [
                    'head' => $this->validationString,
                    'text' => $this->validationText
                ]
            )
        );
        for ($i=0;$i<count($content->images);$i++) {
            $this->processingFile($request,'preview'.$i, 'images/contents/', pathinfo($content->images[$i]->preview)['basename']);
            $this->processingFile($request,'full'.$i, 'images/contents/', pathinfo($content->images[$i]->full)['basename']);
        }
        return redirect(route('admin.contents'));
    }

    public function faq(Request $request, $slug=null): View
    {
        return $this->getSomething (
            $request,
            new Question(),
            'faq',
            'questions',
            'admin.edit_question',
            'admin.adding_question',
            'questions',
            'question',
            $slug
        );
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editFaq(Request $request): RedirectResponse
    {
        $this->editSomething (
            $request,
            new Question(),
            [
                'question' => $this->validationString,
                'answer' => $this->validationText
            ]
        );
        return redirect(route('admin.faq'));
    }

    public function deleteFaq(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new Question());
    }

    public function contacts(Request $request, $slug=null): View
    {
        return $this->getSomething(
            $request,
            new Contact(),
            'contacts',
            'contacts',
            'admin.edit_contact',
            'admin.adding_contact',
            'contacts',
            'contact',
            $slug
        );
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editContact(Request $request): RedirectResponse
    {
        $this->editSomething (
            $request,
            new Contact(),
            [
                'contact' => $this->validationString,
                'type' => 'required|integer|min:1|max:4'
            ]
        );
        return redirect(route('admin.contacts'));
    }

    public function deleteContact(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new Contact());
    }

    public function metrics(Request $request, $slug=null): View
    {
        return $this->getSomething(
            $request,
            new Metric(),
            'metrics',
            'metrics',
            'admin.edit_metric',
            'admin.adding_metric',
            'metrics',
            'metric',
            $slug
        );
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editMetric(Request $request): RedirectResponse
    {
        $this->editSomething (
            $request,
            new Metric(),
            ['name' => $this->validationString, 'code' => $this->validationText]
        );
        return redirect(route('admin.metrics'));
    }

    public function deleteMetric(Request $request): JsonResponse
    {
        return $this->deleteSomething($request, new Metric());
    }

    private function getSomething (
        Request $request,
        Model $model,
        string $menuKey,
        string $itemName,
        string $editNameTitle,
        string $addNameTitle,
        string $viewForList,
        string $viewForOne,
        string $slug = null,
    ): View
    {
        $this->data['menu_key'] = $menuKey;
        $this->breadcrumbs[] = $this->menu[$menuKey];
        if ($request->has('id')) {
            if ($itemName != 'news') $itemName = substr($itemName, 0, -1);
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
            if ($model instanceof News) $this->data[$itemName] = $model->where('active',1)->orderBy('time','desc')->get();
            else $this->data[$itemName] = $model->all();
            return $this->showView($viewForList);
        }
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    private function editSomething (
        Request $request,
        Model $model,
        array $validationArr
    ): Model
    {
        if ($request->has('id')) {
            $validationArr['id'] = 'required|integer|exists:'.$model->getTable().',id';

            $fields = $this->validate($request, $validationArr);
            $fields['active'] = isset($request->active) && $request->active ? 1 : 0;
            if (isset($fields['time'])) $fields['time'] = $this->convertTime($fields['time']);

            $table = $model->find($request->input('id'));
            $table->update($fields);
        } else {
            $fields = $this->validate($request, $validationArr);
            $fields['active'] = $request->active ? 1 : 0;
            if (isset($fields['time'])) $fields['time'] = $this->convertTime($fields['time']);

            $table = $model->create($fields);

            if ($model instanceof News) {
                $news = News::where('active',1)->orderBy('time','asc')->get();
                if (count($news) > 6) {
                    $news[0]->delete();
                    unlink(base_path('public/images/news/news' . $news[0]->id . '.jpg'));
                }
            }
        }
        $this->saveCompleteMessage();
        return $table;
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    private function deleteSomething(Request $request, Model $model): JsonResponse
    {
        $this->validate($request, ['id' => 'required|integer|exists:'.$model->getTable().',id']);
        $table = $model->find($request->input('id'));

        if ($model instanceof Icon) {
            unlink(base_path('public/images/icons/icon' . $table->id . '.png'));
        } else if ($model instanceof News) {
            unlink(base_path('public/images/news/news' . $table->id . '.jpg'));
        } elseif (isset($table->image) && $model->image && file_exists(base_path('public/'.$model->image))) {
            unlink(base_path('public/'.$model->image));
        } elseif (isset($table->path) && $model->path && file_exists(base_path('public/'.$model->path))) {
            unlink(base_path('public/'.$model->path));
        } elseif (isset($table->images)) {
            foreach ($table->images as $image) {
                if (file_exists(base_path('public/'.$image->preview))) unlink(base_path('public/'.$image->preview));
                if (file_exists(base_path('public/'.$image->full))) unlink(base_path('public/'.$image->full));
            }
        }

//        $table->delete();
        return response()->json(['success' => true]);
    }

    private function showView($view): View
    {
        return view('admin.'.$view, [
            'breadcrumbs' => $this->breadcrumbs,
            'data' => $this->data,
            'menu' => $this->menu
        ]);
    }
}
