<?php

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

Route::get('/', function () {
    return redirect('login');
});

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
    'confirm' => false,
]);

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('/users', 'UserController', ['except' => ['show']]);
    Route::post('users/search', 'UserController@search')->name('users.search');
    Route::resource('/roles', 'RoleController', ['except' => ['show']]);
    Route::post('roles/search', 'RoleController@search')->name('roles.search');
    Route::resource('cards', 'OwnerCardController', ['except' => ['show']]);
    Route::post('cards/search', 'OwnerCardController@search')->name('cards.search');
    Route::resource('cardgroups', 'OwnerCardGroupController', ['except' => ['show']]);
    Route::post('cardgroups/search', 'OwnerCardGroupController@search')->name('cardgroups.search');
    Route::resource('notes', 'OwnerNoteController');
    Route::post('notes/search', 'OwnerNoteController@search')->name('notes.search');
});

Route::prefix('user')->name('user.')->group(function () {
    Route::resource('cards', 'CardController', ['except' => ['show']]);
    Route::post('cards/search', 'CardController@search')->name('cards.search');
    Route::resource('cardgroups', 'CardGroupController', ['except' => ['show']]);
    Route::post('cardgroups/search', 'CardGroupController@search')->name('cardgroups.search');
    Route::resource('notes', 'NoteController');
    Route::post('notes/search', 'NoteController@search')->name('notes.search');
});

Route::get('/profile/{id}', 'UserController@showProfile')->name('users.profile');
Route::put('/profile/{id}', 'UserController@updateProfile')->name('users.profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');