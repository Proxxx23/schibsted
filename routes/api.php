<?php

use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/info/repositories/{gitHubUser}', 'InformationController@listUserRepositories');
Route::get('/info/detailed/{gitHubUser}', 'InformationController@userDetails');

Route::get('/stats/detailed/{username}/{repository}', 'StatisticsController@repositoryDetails');
Route::get('/stats/compare/{firstRepositorySet}/{secondRespositorySet}',
            'StatisticsController@compareRepositories');
