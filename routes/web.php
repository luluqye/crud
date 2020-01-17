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

Route::get('/', function () {
    return redirect()->route('login');
});
Route::group(['middleware' => 'web'], function () {
    Route::get('login', 'Auth\LoginController@login')->name('login');
    Route::post('login', 'Auth\LoginController@authenticate')->name('login.post');
    Route::any('logout','Auth\LoginController@logout')->name('logout');
});

Route::group(['middleware' => ['web','auth']], function () {
    //Dashboard
    Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
    //Account
    Route::prefix('account')->group(function () {
        Route::get('/list', 'Admin\AccountController@index')->name('admin.account.list');
        Route::get('/add', 'Admin\AccountController@add')->name('admin.account.add');
        Route::post('/insert', 'Admin\AccountController@insert')->name('admin.account.insert');
        Route::get('/edit/{id}', 'Admin\AccountController@edit')->name('admin.account.edit');
        Route::post('/update/{id}', 'Admin\AccountController@update')->name('admin.account.update');
        Route::get('/delete/{id}', 'Admin\AccountController@delete')->name('admin.account.delete');
    });
    //Data
    Route::prefix('data')->group(function () {
        Route::get('/list', 'Admin\DataController@index')->name('admin.data.list');
        Route::get('/add', 'Admin\DataController@add')->name('admin.data.add');
        Route::post('/insert', 'Admin\DataController@insert')->name('admin.data.insert');
        Route::get('/edit/{id}', 'Admin\DataController@edit')->name('admin.data.edit');
        Route::post('/update/{id}', 'Admin\DataController@update')->name('admin.data.update');
        Route::get('/delete/{id}', 'Admin\DataController@delete')->name('admin.data.delete');
    });
});
//Route::get('/list', 'Admin\AccountController@index')->name('admin.account.list');



