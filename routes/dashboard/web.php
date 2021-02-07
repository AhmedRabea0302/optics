<?php 

    Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function() {
        Route::get('home' , 'DashboardController@index')->name('index');

        // Users Routes
        Route::resource('users', 'UserController')->except(['show']);
    });