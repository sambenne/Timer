<?php

    /*
    |--------------------------------------------------------------------------
    | Application Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the routes for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the Closure to execute when that URI is requested.
    |
    */

    Route::get( '/', function () {
        if( Auth::check() ) {
            return Redirect::to('dashboard');
        }
        return View::make( 'login.login' );
    } );

    Route::get( '/login', function () {
        return View::make( 'login.login' );
    } );

    Route::post( '/login', 'UserController@doLogin' );
    Route::post( '/logout', 'UserController@doLogout' );

    Route::post( '/register', 'UserController@register' );

    // Require Login
    Route::group( [ 'before' => 'auth' ], function () {

        Route::get( '/dashboard', 'DashboardController@show' );

        Route::post( '/timer', 'TimerController@start' );

        Route::put( '/timer/{id}', 'TimerController@stop' );

        Route::get( '/projects', 'ProjectController@show' );

        Route::post( '/projects', 'ProjectController@create');
    } );

    // ===============================================
    // 404 ===========================================
    // ===============================================

    App::missing(function($exception)
    {

        // shows an error page (app/views/error.blade.php)
        // returns a page not found error
//        return Response::view('error', [ ], 404);
    });