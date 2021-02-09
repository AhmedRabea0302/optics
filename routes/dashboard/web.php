<?php 

    Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function() {
        Route::get('home' , 'DashboardController@index')->name('index');

        // Users Routes
        Route::get('all-users', 'UsersController@index')->name('get-all-users');
        Route::get('add-user', 'UsersController@getAddUser')->name('get-add-user');
        Route::post('add-user', 'UsersController@postAddUser')->name('post-add-user');

        Route::get('update-user/{id}', 'UsersController@getUpdateUser')->name('get-update-user');
        Route::post('update-user/{id}', 'UsersController@postUpdateUser')->name('post-update-user');

        Route::get('delete-admin/{id}' ,'UsersController@deleteAdmin')->name('delete-admin');

        // Customers Routes
        Route::get('all-customers' ,'CustomerController@index')->name('get-all-customers');
        Route::get('add-customer' ,'CustomerController@getAddCustomer')->name('get-add-customer');
        Route::post('add-customer' ,'CustomerController@postAddCustomer')->name('post-add-customer');
    });