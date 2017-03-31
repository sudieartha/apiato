<?php

// TODO: these needs to be separated into multiple routes files

Route::group(['domain' => 'admin.'. parse_url(\Config::get('app.url'))['host']], function ($router) {


    Route::get('/', [
        'uses' => 'Controller@showLoginPage',
    ]);

    Route::get('/login', [
        'uses' => 'Controller@showLoginPage',
    ]);

    Route::post('/login', [
        'as'   => 'admin_login',
        'uses' => 'Controller@loginAdmin',
    ]);

    $router->post('/logout', [
        'as'   => 'admin_logout',
        'uses' => 'Controller@logoutAdmin',
    ]);

    Route::get('/dashboard', [
        'uses'       => 'Controller@viewDashboardPage',
        'middleware' => [
            'web.auth'
        ],
    ]);
});
