<?php

Route::group(['middleware' => 'api'], function () {
    Route::get('/api/v1/getdhcpfile', 'ApiController@getDhcpFile');
});

Route::group(['middleware' => 'web'], function () {

    Route::auth();
    
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/home', function () {
        return view('welcome');
    });


    Route::group(['middleware' => 'auth'], function () {
        Route::group(['prefix' => 'dhcp'], function () {
            Route::get('/', 'DhcpController@index');
            Route::get('/create', 'DhcpController@create');
            Route::post('/create', 'DhcpController@store');
            Route::get('/edit/{id}', 'DhcpController@edit');
            Route::post('/edit/{id}', 'DhcpController@update');
            Route::delete('/delete/{id}', 'DhcpController@destroy');
            Route::get('/search/{term}', 'DhcpController@search');
            Route::get('/bulkedit/{term?}', 'DhcpController@bulkEdit');
            Route::post('/bulkedit', 'DhcpController@bulkUpdate');

            Route::get('/options/{subnet_id?}', 'DhcpOptionController@edit');
            Route::post('/options/{subnet_id?}', 'DhcpOptionController@update');

            Route::get('/networks', 'DhcpNetworkController@index');
            Route::get('/networks/create', 'DhcpNetworkController@create');
            Route::post('/networks/create', 'DhcpNetworkController@store');
            Route::get('/networks/edit/{id}', 'DhcpNetworkController@edit');
            Route::post('/networks/edit/{id}', 'DhcpNetworkController@update');

            Route::get('/subnets', 'DhcpSubnetController@index');
            Route::get('/subnets/edit', 'DhcpSubnetController@create');
            Route::post('/subnets/create', 'DhcpSubnetController@store');
            Route::get('/subnets/edit/{id}', 'DhcpSubnetController@edit');
            Route::post('/subnets/edit/{id}', 'DhcpSubnetController@update');

            Route::get('/ranges/edit/{id}', 'DhcpRangeController@edit');
            Route::post('/ranges/edit/{id}', 'DhcpRangeController@update');
        });

        Route::group(['prefix' => 'license'], function () {
            Route::get('/', 'LicenseController@index');
            Route::get('/create', 'LicenseController@create');
            Route::post('/create', 'LicenseController@store');
            Route::get('/edit/{id}', 'LicenseController@edit');
            Route::post('/edit/{id}', 'LicenseController@update');
            Route::delete('/delete/{id}', 'LicenseController@destroy');
            Route::get('/search/{term}', 'LicenseController@search');
            Route::get('/getlicencelist', 'LicenseController@list');
        });

        Route::group(['prefix' => 'ipseen'], function () {
            Route::get('/', 'IpController@index');
            Route::get('/search/{term}', 'IpController@search');
        });
    });
});
