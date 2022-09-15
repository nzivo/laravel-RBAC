<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

$api = app('Dingo\Api\Routing\Router');
$api -> version('v1', function($api){
    $api-> get('/cap', 'App\Http\Controllers\CapUsageController@index');
    $api->group(['prefix' => 'auth'], function($api) {
        $api-> post('/signup', 'App\Http\Controllers\UserController@store');
        $api-> post('/login', 'App\Http\Controllers\Auth\AuthController@login');
        $api->group(['middleware' => 'api.auth'],
            function($api){
                $api-> get('/me', 'App\Http\Controllers\Auth\AuthController@currentUser');
                $api-> post('/refresh-token', 'App\Http\Controllers\Auth\AuthController@refresh');
                $api-> post('/logout', 'App\Http\Controllers\Auth\AuthController@logout');
        });
    });

    $api->group(['middleware' => ['role:super-admin'], 'prefix' => 'admin'],
        function($api){
            // MANAGE USERS
            $api->get('/users', 'App\Http\Controllers\Admin\AdminUserController@index');
            $api->patch('/user/{id}', 'App\Http\Controllers\Admin\AdminUserController@update');
            $api->delete('/user/{id}', 'App\Http\Controllers\Admin\AdminUserController@destroy');
            // MANAGE RBAC
            $api->get('/roles', 'App\Http\Controllers\RoleController@index');
            $api->get('/view-role/{id}', 'App\Http\Controllers\RoleController@show');
            $api->get('/view-permissions', 'App\Http\Controllers\RoleController@create');
            $api->post('/assign-roles', 'App\Http\Controllers\RoleController@store');
            $api->patch('/update-role-permissions/{id}', 'App\Http\Controllers\RoleController@update');
            $api->patch('/update-role/{id}', 'App\Http\Controllers\RoleController@edit');
            $api->delete('/delete-role/{id}', 'App\Http\Controllers\RoleController@destroy');

        }
    );

    $api->group(['middleware' => ['role:finance-manager'], 'prefix' => 'finance'],
        function($api){
            // MANAGE FINANCE
            $api->get('/requests', 'App\Http\Controllers\Admin\AdminUserController@finance');

        }
    );
});
