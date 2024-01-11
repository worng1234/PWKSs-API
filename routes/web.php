<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/key', function() {
    return \Illuminate\Support\Str::random(32);
});

// Router Use Controller And Method 
$router->get('/index', 'TestController@index');
// $router->post('/', 'TestController@index');
// $router->put('/', 'TestController@index');
// $router->delete('/', 'TestController@index');

// Router Middleware
$router->get('admin/profile', [
    'middleware' => 'auth',
    'uses' => 'AdminController@showProfile'
]);

// Router Prefix
$router->group(['prefix' => 'api/v1'], function () use ($router) {

    //!Prefix Auth
    $router->group(['prefix' => 'auth'], function () use ($router) {
        $router->post('/login-teacher', 'LoginController@loginTeacher');
        $router->post('/reset-teacher', 'LoginController@resetPasswordTeacher');
        $router->post('/add-teacher', 'LoginController@addUserTeacher');
    });
    
    //!Prefix Schedule
    $router->group(['prefix' => 'schedule'], function () use ($router) {
        $router->post('/byId', 'ScheduleTeacherController@getScheduleById');
        $router->post('/addandedit', 'ScheduleTeacherController@addAndEditSchedule');
        $router->post('/removeschedule', 'ScheduleTeacherController@removeSchedule');
    });
});

