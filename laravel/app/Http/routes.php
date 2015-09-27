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

/*
Route::get('user/profile', [
    'as' => 'profile', 'uses' => 'UserController@showProfile'
]);


Route::group(['middleware' => ['foo', 'bar']], function()
{
    Route::get('/', function()
    {
        // Has Foo And Bar Middleware
    });

    Route::get('user/profile', function()
    {
        // Has Foo And Bar Middleware
    });

});

 */
Route::group(['middleware' => 'auth'], function()
{
    Route::get('/home', [ 'uses' => 'HomeController@index','as' => 'home']);


    Route::get('user/profile', function()
    {
        // Has Foo And Bar Middleware
    });

});




/*
    Route::get('/user/register', ['uses' => 'Auth\AuthController@register','as' => 'user.register']);
    Route::post('/user/register', 'Auth\AuthController@store');
    Route::get('/user/login', 'Auth\AuthController@login');
    Route::get('/user/logout', 'Auth\AuthController@logout');
*/


// Authentication routes...
Route::get('auth/login', ['uses' => 'Auth\AuthController@getLogin','as' => 'login']);
Route::get('auth/logout', ['uses' => 'Auth\AuthController@getLogout','as' => 'logout']);
Route::post('auth/login', ['uses' => 'Auth\AuthController@postLogin']);

// Registration routes...
Route::get('auth/register', ['uses' => 'Auth\AuthController@getRegister','as' => 'register']);
Route::post('auth/register', 'Auth\AuthController@postRegister');

//Reset password
Route::get('password/email', ['uses' => 'Auth\PasswordController@getEmail','as' => 'password.forget']);
Route::get('password/reset/{token}', ['uses' => 'Auth\PasswordController@getReset','as' => 'password.reset']);
Route::controllers([
    'password' => 'Auth\PasswordController',
]);

Route::get('/', function () {
    return view('welcome');
});


//Team Management
Route::group(['middleware' => 'auth'], function()
{
    Route::get('manage/home', [ 'uses' => 'Manage\TeamController@index','as' => 'manage.home']);
    Route::get('manage/team/create', [ 'uses' => 'Manage\TeamController@create','as' => 'manage.team.create']);
    Route::post('manage/team/create', [ 'uses' => 'Manage\TeamController@store','as' => 'manage.team.store']);

    Route::get('manage/team/edit/{team_id}', [ 'uses' => 'Manage\TeamController@edit','as' => 'manage.team.edit']);
    Route::post('manage/team/edit/{team_id}', [ 'uses' => 'Manage\TeamController@update','as' => 'manage.team.update']);


    Route::get('manage/team/member/{team_id}', [ 'uses' => 'Manage\TeamController@member','as' => 'manage.team.member']);
    Route::post('manage/team/member/{team_id}', [ 'uses' => 'Manage\TeamController@member','as' => 'manage.team.member']);

    Route::get('manage/team/subscribe/{team_id}', [ 'uses' => 'Manage\TeamController@subscribe','as' => 'manage.team.subscribe']);

});
