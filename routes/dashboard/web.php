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
        Route::get('update-customer/{id}' ,'CustomerController@getUpdateCustomer')->name('get-update-customer');
        Route::post('update-customer/{id}' ,'CustomerController@postUpdateCustomer')->name('post-update-customer');
        Route::get('delete-customer/{id}' ,'CustomerController@deleteCustomer')->name('delete-customer');
        Route::get('show-customer/{id}' ,'CustomerController@showCustomer')->name('show-customer');

        // Stock Overview Routes
        Route::get('stock-overview/' ,'StockOverview@index')->name('get-stock-overview');
        Route::post('search-item/' ,'StockOverview@searchItem')->name('search-item');
            // Filtering Routes
            Route::post('filter-products-by-cat-id/' ,'StockOverview@filterByCatId')->name('filter-products-cat-id');
            Route::post('filter-products-by-brand-id/' ,'StockOverview@filterByBrandId')->name('filter-products-brand-id');
            Route::post('filter-products-by-model-id/' ,'StockOverview@filterByModelId')->name('filter-products-model-id');
            Route::post('filter-products-by-size/' ,'StockOverview@filterBySize')->name('filter-products-size');
            Route::post('filter-products-by-color/' ,'StockOverview@filterByColor')->name('filter-products-color');

            Route::post('filter-brands-bycatid/' ,'StockOverview@filterBrandsByCatId')->name('filter-brands-by-category-id');
            Route::post('filter-brands-bybrandid/' ,'StockOverview@filterModelsByBrandId')->name('filter-models-by-brand-id');


        // Categories Routes
        Route::get('all-categories/' ,'CategoryController@index')->name('get-all-categories');
        Route::post('add-category/' ,'CategoryController@addCategory')->name('add-category');
        Route::post('update-category/' ,'CategoryController@updateCategory')->name('update-category');

        // Branches Routes
        Route::get('all-branches/' ,'BranchController@index')->name('get-all-branches');
        Route::post('add-branche/' ,'BranchController@addBranch')->name('add-branche');
        Route::post('update-branche/' ,'BranchController@updateBranch')->name('update-branche');

        // Branches Routes
        Route::get('all-products/' ,'ProductController@index')->name('get-all-products');
        Route::get('add-product/' ,'ProductController@getAddProduct')->name('get-add-product');
        Route::post('add-product/' ,'ProductController@postAddProduct')->name('post-add-product');
        Route::post('update-product/' ,'ProductController@updateProduct')->name('update-product');

        // Brands Routes
        Route::get('all-brands/' ,'BrandController@index')->name('get-all-brands');
        Route::post('add-brand/' ,'BrandController@addBrand')->name('post-add-brand');
        Route::post('update-brand/' ,'BrandController@updateBrand')->name('update-brand');

        // Models Routes
        Route::get('all-models/' ,'GlassModelController@index')->name('get-all-models');
        Route::post('add-model/' ,'GlassModelController@addModel')->name('post-add-model');
        Route::post('update-model/' ,'GlassModelController@updateModel')->name('update-model');


    });
