<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaticController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [StaticController::class, 'index'])->name('home');
Route::post('/request', [FeedbackController::class, 'sendRequest'])->name('request');
Route::post('/request_short', [FeedbackController::class, 'sendShortRequest'])->name('request_short');
//Route::get('/change-lang', [StaticController::class, 'changeLang'])->name('change_lang');

//Route::get('/login', function () {
//    return view('auth.login');
//})->name('login');
//Route::post('/login', [LoginController::class, 'login'])->name('enter');
//Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
//    Route::get('/', [AdminController::class, 'home'])->name('home');
//
//    Route::get('/users/{slug?}', [AdminController::class, 'users'])->name('users');
//    Route::post('/edit-user', [AdminController::class, 'editUser'])->name('edit_user');
//    Route::post('/delete-user', [AdminController::class, 'deleteUser'])->name('delete_user');
//
//    Route::get('/news/{slug?}', [AdminController::class, 'news'])->name('news');
//    Route::post('/edit-news', [AdminController::class, 'editNews'])->name('edit_news');
//    Route::post('/delete-news', [AdminController::class, 'deleteNews'])->name('delete_news');
//
//    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
//    Route::post('/edit-settings', [AdminController::class, 'editSettings'])->name('edit_settings');
//
//    Route::get('/contacts', [AdminController::class, 'contacts'])->name('contacts');
//    Route::post('/edit-contact', [AdminController::class, 'editContact'])->name('edit_contact');
//
//    Route::get('/why-us/{slug?}', [AdminController::class, 'whyUs'])->name('why_us');
//    Route::post('/edit-why-us', [AdminController::class, 'editWhyUs'])->name('edit_why_us');
//    Route::post('/delete-why-us', [AdminController::class, 'deleteWhyUs'])->name('delete_why_us');
//
//    Route::get('/projects-types/{slug?}', [AdminController::class, 'projectsTypes'])->name('projects_types');
//    Route::post('/edit-projects-type', [AdminController::class, 'editProjectsType'])->name('edit_projects_type');
//    Route::post('/delete-projects-type', [AdminController::class, 'deleteProjectsType'])->name('delete_projects_type');
//
//    Route::get('/projects/{slug?}', [AdminController::class, 'projects'])->name('projects');
//    Route::post('/edit-project', [AdminController::class, 'editProject'])->name('edit_project');
//    Route::post('/delete-project', [AdminController::class, 'deleteProject'])->name('delete_project');
//
//    Route::get('/contents', [AdminController::class, 'contents'])->name('contents');
//    Route::post('/edit-content', [AdminController::class, 'editContent'])->name('edit_content');
//});
