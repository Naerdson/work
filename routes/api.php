<?php
use Illuminate\Support\Facades\Route;


Route::namespace('Api')->group(function () {
    Route::post('ouvidoria', 'OuvidoriaController@store');
    Route::get('historico', 'OuvidoriaController@show');
    Route::get('recursos-ouvidoria', 'RecursosIniciaisOuvidoriaController@index');
});



