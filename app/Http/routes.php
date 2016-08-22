<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::group(['middleware' => 'admin'], function() {

    Route::get('/admin', function() {
        return view('admin.index');
    });

    Route::resource('admin/users', 'AdminUsersController');
    Route::resource('admin/posts', 'AdminPostsController');
    Route::resource('admin/categories', 'AdminCategoriesController');
    Route::resource('admin/tags', 'AdminTagsController');

    Route::get('/admin/medias', ['as'=>'admin.medias.index', 'uses'=>'AdminMediasController@index']);
    Route::get('/admin/medias/create', ['as'=>'admin.medias.create', 'uses'=>'AdminMediasController@create']);
    Route::post('admin/medias', 'AdminMediasController@store');

    // handle uploading images from froala editor
});


Route::get('/', 'HomeController@index');

Route::get('{category}/{id_title}', ['as' => 'show', 'uses' => 'PostsController@show']);









