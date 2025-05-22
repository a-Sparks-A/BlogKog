<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

//Админ-панель
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [MainController::class, 'index'])->name('admin.index'); //Главная страница админки
    //Управление контентом
    Route::resource('/categories', CategoryController::class);
    Route::resource('/tags', TagController::class);
    Route::resource('/posts', PostController::class);
});

Route::group(['middleware' => ['auth']], function () {
    //Контент, доступный авторизованным пользователям
    Route::get('/all-posts', [PostController::class, 'index'])->name('posts');
    Route::get('/post/{id}', [PostController::class, 'show'])->name('posts.single');
    Route::get('/all-category/{id}', [CategoryController::class, 'show'])->name('category.show');
    Route::get('/all-tags/{id}', [TagController::class, 'show'])->name('tag.show');
    Route::get('/search', [SearchController::class, 'index'])->name('search');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => 'guest'], function () {
    //Регистрация и авторизация
    Route::get('/register', [UserController::class, 'create'])->name('register.create');
    Route::post('/register', [UserController::class, 'store'])->name('register.store');
    Route::get('/login', [UserController::class, 'loginForm'])->name('login.create');
    Route::post('/login', [UserController::class, 'login'])->name('login');
});
