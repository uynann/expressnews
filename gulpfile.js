var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss')

    .styles([
       'libs/blog-post.css',
       'libs/bootstrap.css',
       'libs/font-awesome.css',
       'libs/metisMenu.css',
       'libs/sb-admin-2.css',
    ], './public/css/libs.css')

    .scripts([
       'libs/jquery.js',
       'libs/bootstrap.js',
       'libs/metisMenu.js',
       'libs/sb-admin-2.js',
    ], './public/js/libs.js')

});



