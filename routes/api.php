<?php
Route::get('/repository/list/{gitHubUser}', 'RepositoryController@listUserRepositories');
Route::get('/repository/stats/{username}/{repository}', 'RepositoryController@repositoryDetails');
Route::get('/repository/compare/{firstRepositorySet}/{secondRepositorySet}',
    'RepositoryController@compareRepositories');

Route::get('/user/info/{gitHubUser}', 'UserController@userDetails');