# Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).


=========================================================================================================================

1. php artisan make:auth
2. create admin folder in the view
3. create categories, posts and users folders in the admin
4. git init, git add. , git commit -m "message"
5. modify User model and create Role model
6. Relationship setup between uses and roles table

7. Create resource route for admin/user  Route::resource('admin/users', 'AdminUsersController');
8. Create AdminUsersController    php artisan make:controller --resource AdminUsersController

9. Install nodejs packages   npm install

10. modify gulpfile.js (to merge all css files to 1 file and all js files to 1 file)and run (gulp)

11. add admin.blade.php to layouts view folder

12. add index.blade.php to admin/users

13. add create.blade.php to admin/uses

14. require laravelcollective/html

15. create UsersCreateRequest (php artisan make:request UsersCreateRequest)

16. create Photo model and migration

17. adding dropzoneJs and handling the server for uploading photo

18. adding edit page for users

** Request for Create Update and Delete

------------------------------------------------------------------------------------------------------------
public function rules()
{
    $user = User::find($this->users);

    switch($this->method())
    {
    case 'GET':
    case 'DELETE':
    {
        return [];
    }
    case 'POST':
    {
        return [
            'user.name.first' => 'required',
            'user.name.last'  => 'required',
            'user.email'      => 'required|email|unique:users,email',
            'user.password'   => 'required|confirmed',
        ];
    }
    case 'PUT':
    case 'PATCH':
    {
        return [
            'user.name.first' => 'required',
            'user.name.last'  => 'required',
            'user.email'      => 'required|email|unique:users,email,'.$user->id,
            'user.password'   => 'required|confirmed',
        ];
    }
    default:break;
    }
}

------------------------------------------------------------------------------------------------------------


20. Implementing deleting of Users

21. Add Security (Add middleware Admin to all admin route)

22. Create Migration and Models for Posts

23. Create index.blade.php in admin/posts folder and display all posts
24. Carete create.balde.php in admin/posts and handle the create route
25. Add status and deleted_at column to posts table and implement softDelete to posts table
26. Add froala editor to create post page

27. Add Edit page and delete functionality to post and handled the route

28. Add Categories and Tags page and handle route for crud

29. Add Medais Page and handle route

29. Modify Post author, if author is deleted. Detach tag and category from post, if tag and category are deleted.

30. Modify app.blade.php layout for frontend. Modify HomeController for homepage. Add ComposerServiceProvider.


