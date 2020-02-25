<?php

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

Auth::routes();

// Only for local develop or debug
if (env('APP_ENV') != 'production') {
    Route::get('/tmp', 'TmpController@index')->name('tmp');
}

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('logs', 'Docs\LogsViewerController@logs')->name('logs');
Route::get('logs-viewer', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('logs.viewer');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    Route::resource('products','ProductController');
});
