<?php

use Illuminate\Support\Facades\Route;

define('PAGINATION_COUNT',10);
Route::group(['namespace'=>'Admin','middleware' => 'auth:admin'], function() {
    Route::get('/', 'DashboardController@index') -> name('admin.dashboard');
    Route::post('/logout', 'LoginController@logout') -> name('admin.logout');
    #################################Begin Languages Routes##############
    Route::group(['prefix'=>'languages'] , function (){

        Route::get('/','LanguagesController@index')->name('admin.languages');
        Route::get('/create','LanguagesController@create')->name('admin.languages.create');
        Route::post('/store','LanguagesController@store')->name('admin.languages.store');
        Route::get('/edit/{id}','LanguagesController@edit')->name('admin.languages.edit');
        Route::post('/update/{id}','LanguagesController@update')->name('admin.languages.update');
        Route::get('/delete/{id}','LanguagesController@destroy')->name('admin.languages.delete');


    });

    #################################End Languages Routes################
});



Route::group(['namespace'=>'Admin','middleware' => 'guest:admin'], function(){
    Route::get('login' ,'LoginController@getLogin')-> name('get.admin.login');
    Route::post('login' ,'LoginController@login') -> name('admin.login');
});


//Route::get('/', function () {
//    return view('frontend.home');
//});
//
//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');
