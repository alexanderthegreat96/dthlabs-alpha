<?php
use LexSystems\Framework\Core\Kernel\Route;


/**
 * Simple routes
 */
Route::get('/','MyController@index');
Route::get('/login','Login@index', ['after' => 'AfterAuth']);
Route::post('/login/try', 'Login@try', ['after' => 'AfterAuth']);

/**
 * Route groups
 */

Route::group('admin', function()
{
    Route::get('/','Admin@index');
    Route::get('/users','Admin@users');
},
    [
        /**
         * Middlewares
         * Check if user is authenticated
         */
        'before' => 'BeforeAuth',

        /**
         * Check any other parameters
         * like the user rank
         * or user status
         */
        'after' => 'AfterAuth'
    ]
);
