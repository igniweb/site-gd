<?php

$app->get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
$app->get('search', ['as' => 'search', 'uses' => 'HomeController@search']);

$app->get('sandbox', function () use ($app) {
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
