<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'Auth\LoginController@index')->name('auth.login');
Route::post('/', 'Auth\LoginController@login')->name('login');

Route::prefix('admin')->group(function () {
    Route::get('ouvidoria/home', 'Admin\Ouvidoria\OuvidoriaController@index')->name('ouvidoria.home');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
    Route::put('ouvidoria/home', 'Admin\Ouvidoria\HistoricoController@forwardOccurrence')->name('ouvidoria.home.encaminhar');
    Route::put('ouvidoria/home/responder', 'Admin\Ouvidoria\HistoricoController@replyOccurrenceByEmail')->name('ouvidoria.home.responder.email');
    Route::put('ouvidoria/home/encerrar/{id}', 'Admin\Ouvidoria\HistoricoController@finishOccurrence')->name('ouvidoria.home.encerrar');
    Route::get('ouvidoria/historico/{id}', 'Admin\Ouvidoria\HistoricoController@getHistoric')->name('ouvidoria.historico');
});
