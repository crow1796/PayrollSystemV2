<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
	Route::auth();

    Route::group(['middleware' => ['notauth']], function(){
    	Route::get('/', 'PayrollPagesController@index');

        Route::resource('/employees', 'EmployeeManagementController');

        // /payroll/*
        Route::group(['prefix' => 'payroll'], function(){
            // /payroll/dtr/*
            Route::group(['prefix' => 'dtr'], function(){
                Route::get('/manual', 'PayrollTransactionController@createManual');

                // /payroll/dtr/import/*
                Route::get('/import', 'PayrollTransactionController@createImport');
                Route::group(['prefix' => 'import'], function(){
                    Route::post('/uploading', 'PayrollTransactionController@storeImport');
                });
            });
            // Transaction confirm
            Route::post('/create/confirm', 'PayrollTransactionController@confirmTransaction');
        });
        Route::resource('/payroll', 'PayrollTransactionController');

        Route::get('/calendar', 'CalendarController@eventsList');
        Route::resource('/calendar', 'CalendarController', ['except' => ['show']]);
        
        // /control-access/*
        Route::group(['prefix' => '/control-access'], function(){
            Route::get('/logs', 'ControlAccessController@logs');
            Route::delete('/logs/{log}', 'ControlAccessController@logDestroy');
        });
        Route::resource('/control-access', 'ControlAccessController', ['except' => 'show']);

        // /api/*
        Route::group(['prefix' => '/api'], function(){
            Route::get('/events', 'CalendarController@events');
            Route::get('/match-employees', 'EmployeeManagementController@matchEmployees');
            Route::post('/add-employee-dtr', 'PayrollTransactionController@storeManual');
        });
    });

});
