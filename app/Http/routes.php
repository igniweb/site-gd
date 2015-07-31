<?php

$app->get('/', function () use ($app) {
    throw new App\Exceptions\AuthException('Invalid user credentials.');
    
    return $app->welcome();
});
