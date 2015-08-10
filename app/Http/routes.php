<?php

$app->get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
$app->get('search', ['as' => 'search', 'uses' => 'HomeController@search']);

$app->group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Admin'], function ($app) {
    // REST users
    $app->get('user', ['as' => 'admin.user.index', 'uses' => 'UserController@index']);
    $app->get('user/datatable', ['as' => 'admin.user.datatable', 'uses' => 'UserController@dataTable']);
    $app->get('user/create', ['as' => 'admin.user.create', 'uses' => 'UserController@create']);
    $app->post('user', ['as' => 'admin.user.store', 'uses' => 'UserController@store']);
    $app->get('user/{id}/edit', ['as' => 'admin.user.edit', 'uses' => 'UserController@edit']);
    $app->put('user/{id}', ['as' => 'admin.user.update', 'uses' => 'UserController@update']);
    $app->delete('user/{id}', ['as' => 'admin.user.destroy', 'uses' => 'UserController@destroy']);
});

$app->get('sandbox', function () use ($app) {
    //$user = app('App\Repositories\Contracts\UserRepository')->byId(1);
    //dd($user);

    //dd($app);
    //dd(app()->environment());

    //app('log')->debug('Debug');
    //app('log')->info('Info');
    //app('log')->notice('Notice');
    //app('log')->warning('Warning');
    //app('log')->error('Error');
    //app('log')->critical('Critical');
    //app('log')->alert('Alert');
    
    //throw new App\Exceptions\AuthException('Invalid user credentials.');
});
