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
    return view('welcome');
});

// ADMIN PANEL
// Route::get('manage', 'manage\SigninController@index');
// Route::get('/manage/logout', function () {
//     Auth::logout();
//     return redirect('/manage');
// });
// Route::get('manage/signin', 'manage\SigninController@index');
// Route::get('manage/signin/insert', 'manage\SigninController@insert');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/manage/register', 'manage\RegisterController@index');



Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/admin', 'HomeController@index');

});