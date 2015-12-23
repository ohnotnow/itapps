<?php

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'web'], function () {

    Route::auth();

    Route::group(['prefix' => 'dhcp'], function () {
        Route::get('/', 'DhcpController@index');
        Route::get('/create', 'DhcpController@create');
        Route::post('/create', 'DhcpController@store');
        Route::get('/edit/{id}', 'DhcpController@edit');
        Route::post('/edit/{id}', 'DhcpController@update');
        Route::delete('/delete/{id}', 'DhcpController@destroy');
        Route::get('/search/{term}', 'DhcpController@search');
        Route::get('/getdhcpfile', 'DhcpController@dhcpFile');
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
