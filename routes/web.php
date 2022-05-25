<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserArticles;
use App\Http\Livewire\Admin\UsersIndex;
use App\Http\Livewire\Admin\AdminArticle;
use App\Http\Livewire\User\UserArticle;
use App\Http\Controllers\Controller;
use App\Models\User;
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

// Route::get('/', function () {
//     return view('welcome')->name('welcome');
// });

// Route::get('/', [Welcome::class, 'render']);
Route::get('/', [Controller::class, 'k'])->name('welcome');
Route::get('/h', [Controller::class, 'userLogout'])->name('userLogout');

Route::middleware('auth')->prefix('user')->group(function (){
    Route::get('/', [UserArticles::class, 'article'])->name('users.article');
});
Route::get('/login',[AuthController::class, 'login'])->name('login');



Route::group(['middleware' => ['auth','IsAdmin'],'prefix'=>'admin'], function () {
    Route::get('/', UsersIndex::class)->name('users.index');
    Route::get('/article', AdminArticle::class)->name('article');
});

