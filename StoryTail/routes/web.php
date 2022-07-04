<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});*/


Route::get('/', function () {

    return (auth()->check() && auth()->user()->hasVerifiedEmail() && auth()->user()->active)
        ? redirect('home')
        : redirect('login');
});

/*Auth::routes();*/
Auth::routes(['verify' => true]);
Route::middleware(['auth', 'verified'])->group(function () {

    /* Route::get('/home', 'HomeController@index')->name('home');*/
    Route::get('/validation', 'UserController@redirectTo')->name('validation');
});

Route::middleware(['auth', 'verified', 'active'])->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/wordle-story-tail', 'HomeController@wordleView')->name('wordle');
    Route::get('/my-account/{user:slug}', 'MyaccountController@show')->name('my-account');
    Route::put('/my-account-update/{user}', 'MyaccountController@update')->name('my-account-update');
    Route::post('upload-image-user','UploadController@storeTempImageUser');
    Route::get('/books/{book:slug}', 'BookController@bookViewer')->name('books-read');
    Route::get('/books/activity/{book:slug}', 'BookController@showActivity')->name('books-activity');
    Route::post('/books-stats/{book}', 'BookController@statsBook')->name('books-stats');
    Route::post('/books-stats-edit/{book}', 'BookController@statsBookEditRating')->name('books-stats-edit-rating');
    Route::put('/user-favourite/{book}', 'UserController@userFavourites')->name('user-favourite');

    Route::prefix('contact')->group(function () {

        Route::get('', 'ContactController@index')->name('contact');
        Route::post('', 'ContactController@sendContactMail')->name('contact.send');
    });


    Route::prefix('admin')->group(function () {

        Route::group(['middleware' => 'can:admin'], function () {

            Route::get('', 'AdminHomeController@index')->name('admin');

            Route::prefix('audio')->group(function () {

                Route::get('create', 'AudioController@create')->name('audio.create');
                Route::post('', 'AudioController@store')->name('audio.store');
                Route::get('', 'AudioController@index')->name('audio.list');
                Route::post('upload-audio','UploadController@storeTempAudio');
                Route::delete('{book}', 'AudioController@destroy')->name('audio.delete');
               /* Route::get('edit/{author}', 'AuthorController@edit')->name('author.edit');
                Route::delete('{author}', 'AuthorController@destroy')->name('author.delete');
                Route::put('update/{author}', 'AuthorController@update')->name('author.update');*/

            });



            Route::prefix('author')->group(function () {

                Route::get('create', 'AuthorController@create')->name('author.create');
                Route::post('', 'AuthorController@store')->name('author.store');
                Route::get('edit/{author}', 'AuthorController@edit')->name('author.edit');
                Route::delete('{author}', 'AuthorController@destroy')->name('author.delete');
                Route::put('update/{author}', 'AuthorController@update')->name('author.update');

            });

            Route::prefix('age-range')->group(function () {

                Route::get('create', 'AgeGroupController@create')->name('age-range.create');
                Route::post('', 'AgeGroupController@store')->name('age-range.store');
                Route::get('edit/{ageGroup}', 'AgeGroupController@edit')->name('age-range.edit');
                Route::delete('{ageGroup}', 'AgeGroupController@destroy')->name('age-range.delete');
                Route::put('update/{ageGroup}', 'AgeGroupController@update')->name('age-range.update');


            });

            Route::prefix('book-theme')->group(function () {

                Route::get('create', 'ThemeController@create')->name('book-theme.create');
                Route::post('', 'ThemeController@store')->name('book-theme.store');
                Route::get('edit/{theme}', 'ThemeController@edit')->name('book-theme.edit');
                Route::delete('{theme}', 'ThemeController@destroy')->name('book-theme.delete');
                Route::put('update/{theme}', 'ThemeController@update')->name('book-theme.update');
            });

            Route::prefix('activity-theme')->group(function () {

                Route::get('create', 'ActivityTypeController@create')->name('activity-type.create');
                Route::post('', 'ActivityTypeController@store')->name('activity-type.store');
                Route::get('edit/{activityType}', 'ActivityTypeController@edit')->name('activity-type.edit');
                Route::delete('{activityType}', 'ActivityTypeController@destroy')->name('activity-type.delete');
                Route::put('update/{activityType}', 'ActivityTypeController@update')->name('activity-type.update');
                Route::post('upload-activity-type','UploadController@storeTempActivityType');

            });

            Route::prefix('users')->group(function () {
                Route::get('', 'UserController@index')->name('users.list');
                Route::delete('{user}', 'UserController@destroy')->name('users.delete');
                Route::put('update-active/{user}', 'UserController@activeUpdate')->name('users.update.active');
                Route::put('update-role/{user}', 'UserController@roleUpdate')->name('users.update.role');
            });

            Route::prefix('books')->group(function () {
                Route::get('', 'BookController@index')->name('books.list');
                Route::get('create', 'BookController@create')->name('books.create');
                Route::get('{book:slug}', 'BookController@show')->name('books.show');
                Route::post('', 'BookController@store')->name('books.store');
                Route::delete('{book}', 'BookController@destroy')->name('books.delete');
                Route::get('edit/{book}', 'BookController@edit')->name('books.edit');
                Route::put('update/{book}', 'BookController@update')->name('books.update');
                Route::post('upload-temp','UploadController@storeTempBook');
                Route::post('upload-temp-cover','UploadController@storeTempCoverBook');

            });
        });


    });

});





/*Route::view('/verify','testes.verify2');

Route::get('/teste','TaskController@create')->name('teste');*/

/*Route::get('/teste','TaskController@create')->middleware('can:manage-tasks')->name('teste');*/
