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

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('enter');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'home'])->name('home');

    Route::get('/users/{slug?}', [AdminController::class, 'users'])->name('users');
    Route::post('/edit-user', [AdminController::class, 'editUser'])->name('edit_user');
    Route::post('/delete-user', [AdminController::class, 'deleteUser'])->name('delete_user');

    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/edit-settings', [AdminController::class, 'editSettings'])->name('edit_settings');

    Route::get('/icons/{slug?}', [AdminController::class, 'icons'])->name('icons');
    Route::post('/edit-icon', [AdminController::class, 'editIcon'])->name('edit_icon');
    Route::post('/delete-icon', [AdminController::class, 'deleteIcon'])->name('delete_icon');

    Route::get('/news/{slug?}', [AdminController::class, 'news'])->name('news');
    Route::post('/edit-news', [AdminController::class, 'editNews'])->name('edit_news');
    Route::post('/delete-news', [AdminController::class, 'deleteNews'])->name('delete_news');

    Route::get('/contents', [AdminController::class, 'contents'])->name('contents');
    Route::post('/edit-content', [AdminController::class, 'editContent'])->name('edit_content');

    Route::get('/faq/{slug?}', [AdminController::class, 'faq'])->name('faq');
    Route::post('/edit-faq', [AdminController::class, 'editFaq'])->name('edit_faq');
    Route::post('/delete-faq', [AdminController::class, 'deleteFaq'])->name('delete_faq');

    Route::get('/contacts/{slug?}', [AdminController::class, 'contacts'])->name('contacts');
    Route::post('/edit-contact', [AdminController::class, 'editContact'])->name('edit_contact');
    Route::post('/delete-contact', [AdminController::class, 'deleteContact'])->name('delete_contact');
});
