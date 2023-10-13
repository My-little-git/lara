<?php


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


Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::group(['namespace' => 'Posts', 'as' => 'posts.', 'prefix' => 'posts'], function () {
        Route::get('/create', 'CreateController')->name('create');
        Route::get('/', 'IndexController')->name('index');
        Route::get('/{post}', 'ShowController')->name('show');
        Route::post('/', 'StoreController')->name('store');
        Route::get('/{post}/edit', 'EditController')->name('edit');
        Route::patch('/{post}', 'UpdateController')->name('update');
        Route::delete('/{post}', 'DestroyController')->name('destroy');
    });

    Route::get('/', 'HomeController@index')->name('home');

    Route::group(['namespace' => 'Admin', 'as' => 'admin.', 'prefix' => 'admin', 'middleware' => 'admin'], function () {

        Route::group(['namespace' => 'Posts', 'as' => 'posts.', 'prefix' => 'posts'], function () {

            Route::get('/', 'IndexController')->name('index');

        });

    });

    Route::view('/about', 'about')->name('about');

    Route::view('/contact', 'contact')->name('contact');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
