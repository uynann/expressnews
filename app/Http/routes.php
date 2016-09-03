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

//    Route::get('edit-posts-slug', function() {
//        $posts = Post::withTrashed()->get();
//
//        foreach($posts as $post) {
//            $post->update(['slug' => preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $post->title))) ]);
//        }
//    });

//    Route::get('edit-categories-slug', function() {
//        $categories = Category::all();
//
//        foreach($categories as $category) {
//            $category->update(['slug' => preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $category->name))) ]);
//        }
//    });

//    Route::get('edit-tags-slug', function() {
//        $tags = Tag::all();
//
//        foreach($tags as $tag) {
//            $tag->update(['slug' => preg_replace('/^-+|-+$/', '', strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $tag->name))) ]);
//        }
//    });



    Route::resource('admin/users', 'AdminUsersController');
    Route::post('admin/users/bulkactions', 'AdminUsersController@bulkActions');


    Route::resource('admin/posts', 'AdminPostsController');
    Route::post('admin/posts/bulkactions', 'AdminPostsController@bulkActions');


    Route::resource('admin/categories', 'AdminCategoriesController');
    Route::post('admin/cateogries/bulkactions', 'AdminCategoriesController@bulkActions');


    Route::resource('admin/tags', 'AdminTagsController');
    Route::post('admin/tags/add', 'AdminTagsController@storeFromAjax');
    Route::post('admin/tags/bulkactions', 'AdminTagsController@bulkActions');


    Route::get('/admin/medias', ['as'=>'admin.medias.index', 'uses'=>'AdminMediasController@index']);
    Route::get('/admin/medias/create', ['as'=>'admin.medias.create', 'uses'=>'AdminMediasController@create']);
    Route::post('admin/medias', 'AdminMediasController@store');

    Route::resource('admin/comments', 'AdminCommentsController');
    Route::resource('admin/comment/replies', 'AdminCommentRepliesController');

    // handle uploading images from froala editor
});


Route::get('/', 'HomeController@index');

Route::get('expressnews-login', 'Auth\AuthController@showExpressNewsLoginForm');

Route::get('about', 'HomeController@about');
Route::get('privacy-policy', 'HomeController@privacyPolicy');
Route::get('contact', 'HomeController@contact');


Route::get('{category}/{id_title}', ['as' => 'show', 'uses' => 'PostsController@show']);

Route::get('{category_name}', ['as' => 'category', 'uses' => 'HomeController@category']);

Route::resource('comments', 'CommentsController');

Route::group(['middleware' => 'auth'], function() {

    Route::resource('comments', 'CommentsController');
    Route::resource('comment/replies', 'RepliesController');

});









