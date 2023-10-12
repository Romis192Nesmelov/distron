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

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/login', 'login')->name('enter');
    Route::get('/logout', 'logout')->name('logout');

});

Route::prefix('admin')->middleware(['auth'])->controller(AdminController::class)->name('admin.')->group(function () {
    Route::get('/', 'home')->name('home');

    Route::get('/users/{slug?}', 'users')->name('users');
    Route::post('/edit-user', 'editUser')->name('edit_user');
    Route::post('/delete-user', 'deleteUser')->name('delete_user');

    Route::get('/settings', 'settings')->name('settings');
    Route::post('/edit-settings', 'editSettings')->name('edit_settings');

    Route::get('/icons/{slug?}', 'icons')->name('icons');
    Route::post('/edit-icon', 'editIcon')->name('edit_icon');
    Route::post('/delete-icon', 'deleteIcon')->name('delete_icon');

    Route::get('/news/{slug?}', 'news')->name('news');
    Route::post('/edit-news', 'editNews')->name('edit_news');
    Route::post('/delete-news', 'deleteNews')->name('delete_news');

    Route::get('/contents', 'contents')->name('contents');
    Route::post('/edit-content', 'editContent')->name('edit_content');

    Route::get('/faq/{slug?}', 'faq')->name('faq');
    Route::post('/edit-faq', 'editFaq')->name('edit_faq');
    Route::post('/delete-faq', 'deleteFaq')->name('delete_faq');

    Route::get('/contacts/{slug?}', 'contacts')->name('contacts');
    Route::post('/edit-contact', 'editContact')->name('edit_contact');
    Route::post('/delete-contact', 'deleteContact')->name('delete_contact');

    Route::get('/metrics/{slug?}', 'metrics')->name('metrics');
    Route::post('/edit-metric', 'editMetric')->name('edit_metric');
    Route::post('/delete-metric', 'deleteMetric')->name('delete_metric');
});
