<?php
use Illuminate\Support\Facades\Route;

Route::middleware('Ouvidoria')->group(function () {
    Route::namespace('Api')->group(function () {
        Route::post('ouvidoria', 'Api\OuvidoriaController@store');
        Route::get('historico', 'Api\OuvidoriaController@show');
    });
});
