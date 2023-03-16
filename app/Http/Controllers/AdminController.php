<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use App\Models\Icon;
use App\Models\Project;
use App\Models\ProjectType;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\News;
use App\Models\Setting;
use App\Models\ProjectImage;
use App\Models\Content;
use Illuminate\Support\Str;

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
            'settings' => [
                'id' => 'settings',
                'href' => 'admin.settings',
                'name' => trans('admin_menu.settings'),
                'description' => trans('admin_menu.settings_description'),
                'icon' => 'icon-gear',
            ],
            'users' => [
                'id' => 'users',
                'href' => 'admin.users',
                'name' => trans('admin_menu.admins'),
                'description' => trans('admin_menu.admins_description'),
                'icon' => 'icon-users',
            ],
            'why_us' => [
                'id' => 'why_us',
                'href' => 'admin.why_us',
                'name' => trans('admin_menu.why_us'),
                'description' => trans('admin_menu.why_us_description'),
                'icon' => 'icon-people',
            ],
            'news' => [
                'id' => 'news',
                'href' => 'admin.news',
                'name' => trans('admin_menu.news'),
                'description' => trans('admin_menu.news_description'),
                'icon' => 'icon-newspaper2',
            ],
            'content' => [
                'id' => 'content',
                'href' => 'admin.contents',
                'name' => trans('admin_menu.content'),
                'description' => trans('admin_menu.content_description'),
                'icon' => 'icon-puzzle2',
            ],
            'projects_types' => [
                'id' => 'projects_types',
                'href' => 'admin.projects_types',
                'name' => trans('admin_menu.projects_types'),
                'description' => trans('admin_menu.projects_types_description'),
                'icon' => 'icon-git-branch',
            ],
            'projects' => [
                'id' => 'projects',
                'href' => 'admin.projects',
                'name' => trans('admin_menu.portfolio'),
                'description' => trans('admin_menu.portfolio_description'),
                'icon' => 'icon-portfolio',
            ],
            'contacts' => [
                'id' => 'contacts',
                'href' => 'admin.contacts',
                'name' => trans('admin_menu.contacts'),
                'description' => trans('admin_menu.contacts_description'),
                'icon' => 'icon-collaboration',
            ]
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
                'name' => trans('content.edit_user', ['user' => $this->data['user']->email]),
            ];
            return $this->showView('user');
        } else if ($slug && $slug == 'add') {
            $this->breadcrumbs[] = [
                'id' => $this->menu['users']['id'],
                'href' => $this->menu['users']['href'],
                'slug' => 'add',
                'name' => trans('content.adding_user'),
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

    public function news(Request $request, $slug=null)
    {
        return $this->getSomething(
            $request,new News(),
            'news',
            'news',
            $slug,
            'content.edit_news',
            'content.adding_news',
            'all_news',
            'news'
        );
    }

    public function editNews(Request $request)
    {
        $validationArr = [
            'time' => $this->validationDate,
            'title_ru' => $this->validationString,
            'content_ru' => $this->validationString,
            'title_en' => $this->validationString,
            'content_en' => $this->validationString,
        ];

        return $this->editSometing (
            $request,
            new News(),
            $validationArr,
            $this->validationJpg,
            'images/news/',
            'news%id%.jpg',
            'news'
        );
    }

    public function deleteNews(Request $request)
    {
        return $this->deleteSomething($request, new News());
    }

    public function settings()
    {
        $this->breadcrumbs[] = $this->menu['settings'];
        $this->data['metas'] = $this->metas;
        $this->data['settings'] = Setting::find(1);
        return $this->showView('settings');
    }

    public function editSettings(Request $request)
    {
        $validationArr = [
            'title_ru' => $this->validationString,
            'title_en' => $this->validationString,
        ];

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

    public function contacts(Request $request)
    {
        $this->data['menu_key'] = 'contacts';
        $this->breadcrumbs[] = $this->menu['contacts'];
        if ($request->has('id')) {
            $this->data['contact'] = Contact::find($request->input('id'));
            $this->breadcrumbs[] = [
                'id' => $this->menu['contacts']['id'],
                'href' => $this->menu['contacts']['href'],
                'params' => ['id' => $this->data['contact']->id],
                'name' => trans('content.edit_contact', ['contact_name' => ucfirst($this->data['contact']->type)]),
            ];
            return $this->showView('contact');
        } else {
            $this->data['contacts'] = Contact::all();
            return $this->showView('contacts');
        }
    }

    public function editContact(Request $request)
    {
        $fields = $this->validate($request, [
            'id' => 'required|required|integer|exists:contacts',
            'contact' => $this->validationString
        ]);
        $contact = Contact::find($request->input('id'));
        $fields['active'] = $request->active ? 1 : 0;
        $contact->update($fields);
        $this->saveCompleteMessage();
        return redirect(route('admin.contacts'));
    }

    public function whyUs(Request $request, $slug=null)
    {
        $militaryType = ProjectType::find(1);
        $this->data['heads'] = [
            trans('content.home_page'),
            $militaryType['name_'.app()->getLocale()]
        ];

        return $this->getSomething(
            $request,new Icon(),
            'why_us',
            'icons',
            $slug,
            'content.edit_icon',
            'content.adding_icon',
            'icons',
            'icon'
        );
    }

    public function editWhyUs(Request $request)
    {
        $validationArr = [
            'title_ru' => $this->validationString,
            'title_en' => $this->validationString
        ];

        if ($request->has('description_ru')) {
            $validationArr['description_ru'] = $this->validationText;
            $validationArr['description_en'] = $this->validationText;
        }

        return $this->editSometing (
            $request,
            new Icon,
            $validationArr,
            $this->validationPng,
            'images/icons/',
            'why_us_icon%id%.png',
            'why_us'
        );
    }

    public function deleteWhyUs(Request $request)
    {
        return $this->deleteSomething($request, new Icon());
    }

    public function projectsTypes(Request $request, $slug=null)
    {
        $this->data['types'] = ProjectType::all();
        return $this->getSomething (
            $request,
            new ProjectType(),
            'projects_types',
            'projects_types',
            $slug,
            'content.edit_projects_type',
            'adding_projects_type',
            'projects_types',
            'projects_type'
        );
    }

    public function editProjectsType(Request $request)
    {
        $validationArr = [
            'name_ru' => $this->validationString,
            'name_en' => $this->validationString,
        ];

        if ($request->has('id') && $request->input('id') != 1) {
            $validationArr['description_ru'] = $this->validationText;
            $validationArr['description_en'] = $this->validationText;
        }

        return $this->editSometing (
            $request,
            new ProjectType(),
            $validationArr,
            $this->validationPng,
            'images/projects/',
            'content_image%id%.png',
            'projects_types'
        );
    }

    public function deleteProjectsType(Request $request)
    {
        $this->validate($request, ['id' => 'required|integer|exists:project_types,id|not_in:1']);
        $projectsTypes = ProjectType::find($request->input('id'));

        if (file_exists(base_path('public/'.$projectsTypes->image))) {
            unlink(base_path('public/'.$projectsTypes->image));
        }

        foreach ($projectsTypes->projects as $project) {
            foreach ($project->images as $image) {
                if (file_exists(base_path('public/'.$image->preview))) unlink(base_path('public/'.$image->preview));
                if (file_exists(base_path('public/'.$image->full))) unlink(base_path('public/'.$image->full));
            }
            $project->delete();
        }

        $projectsTypes->delete();
        return response()->json(['success' => true]);
    }

    public function projects(Request $request, $slug=null)
    {
        $this->data['types'] = ProjectType::all();
        return $this->getSomething (
            $request,
            new Project(),
            'projects',
            'projects',
            $slug,
            'content.edit_project',
            'content.adding_project',
            'projects',
            'project'
        );
    }

    public function editProject(Request $request)
    {
        $validationArr = [
            'name_ru' => $this->validationString,
            'name_en' => $this->validationString,
            'description_ru' => $this->validationText,
            'description_en' => $this->validationText,
            'project_type_id' => 'required|integer|exists:project_types,id'
        ];

        return $this->editSometing (
            $request,
            new Project(),
            $validationArr,
            '',
            '',
            '',
            'projects'
        );
    }

    public function deleteProject(Request $request)
    {
        return $this->deleteSomething($request, new Project());
    }

    public function contents(Request $request)
    {
        $militaryType = ProjectType::find(1);
        $this->data['heads'] = [
            trans('menu.about_company'),
            $militaryType['name_'.app()->getLocale()]
        ];
        return $this->getSomething(
            $request,new Content(),
            'content',
            'contents',
            null,
            'content.edit_content',
            '',
            'contents',
            'content'
        );
    }

    public function editContent(Request $request)
    {
        $validationArr = [
            'content_ru' => $this->validationText,
            'content_en' => $this->validationText
        ];

        return $this->editSometing (
            $request,
            new Content(),
            $validationArr,
            '',
            '',
            '',
            'contents'
        );
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
            $itemName = $itemName == 'news' ? 'news' : substr($itemName, 0, -1);
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
            if ($model instanceof News) $this->data[$itemName] = $model->orderBy('time','desc')->get();
            elseif ($model instanceof Project) $this->data[$itemName] = $model->orderBy('project_type_id','desc')->get();
            elseif ($model instanceof Icon) $this->data[$itemName] = $model->orderBy('military')->get();
            else $this->data[$itemName] = $model->all();
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

            if ($model instanceof Project) {
                for ($i=1;$i<=5;$i++) {
                    if ($request->hasFile('image_preview'.$i)) $validationArr['image_preview'.$i] = $this->validationPng;
                    if ($request->hasFile('image_full'.$i)) $validationArr['image_full'.$i] = $this->validationJpg;
                }
            } else if ($validationImage && $request->hasFile('image')) $validationArr['image'] = $validationImage;

            $fields = $this->validate($request, $validationArr);
            if ($model instanceof Icon) $fields['military'] = $request->military ? 1 : 0;
            $fields['active'] = isset($request->active) && $request->active ? 1 : 0;
            if (isset($fields['time'])) $fields['time'] = $this->convertTime($fields['time']);

            $table = $model->find($request->input('id'));
            $table->update($fields);
        } else {
            if ($model instanceof Project) {
                for ($i=1;$i<=5;$i++) {
                    $validationArr['image_preview'.$i] = $this->validationPng;
                    $validationArr['image_full'.$i] = $this->validationJpg;
                }
            } else if ($validationImage) $validationArr['image'] = $validationImage;
            $fields = $this->validate($request, $validationArr);
            if ($model instanceof Icon) $fields['military'] = $request->military ? 1 : 0;
            $fields['active'] = $request->active ? 1 : 0;
            if (isset($fields['time'])) $fields['time'] = $this->convertTime($fields['time']);
            $table = $model->create($fields);
        }

        if ($model instanceof Project) {
            for ($i=1;$i<=5;$i++) {
                $imagePreviewName = $this->movingProjectFile($request, $i, $table->name_en, 'preview');
                $imageFullName = $this->movingProjectFile($request, $i, $table->name_en, 'full');
                if (!$request->has('id')) {
                    ProjectImage::create([
                        'preview' => $imagePreviewName,
                        'full' => $imageFullName,
                        'project_id' => $table->id
                    ]);
                }
            }
        } else if ($validationImage && $request->hasFile('image')) {
            $imageName = str_replace('%id%',$table->id,$imageName);
            $this->processingFile($request,'image',$pathToImages,$imageName);
            if (!$request->has('id')) {
                $table->image = $pathToImages.$imageName;
                $table->save();
            }
        }
        $this->saveCompleteMessage();
        return redirect(route('admin.'.$returnRoute));
    }

    private function movingProjectFile(Request $request, $i, $projectName, $imageSuffix)
    {
        if ($request->hasFile('image_'.$imageSuffix.$i)) {
            $pathToImages = 'images/portfolio/';
            $imageName = Str::slug($projectName).'_'.$i.'_'.$imageSuffix.'.png';
            $this->processingFile($request, 'image_'.$imageSuffix.$i, $pathToImages, $imageName);
            return $pathToImages.$imageName;
        }
    }

    private function deleteSomething(Request $request, Model $model)
    {
        $this->validate($request, ['id' => 'required|integer|exists:'.$model->getTable().',id']);
        $table = $model->find($request->input('id'));

        if (isset($table->image) && $model->image && file_exists(base_path('public/'.$model->image))) {
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
