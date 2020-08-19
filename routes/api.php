<?php
use Illuminate\Support\Facades\Route;

Route::middleware('ouvidoria.auth')->group(function () {
    Route::namespace('Api')->group(function () {
        Route::post('ouvidoria', 'OuvidoriaController@store');
        Route::get('historico', 'OuvidoriaController@show');
        Route::get('recursos-ouvidoria', 'RecursosIniciaisOuvidoriaController@index');
    });
});


