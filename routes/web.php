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

});

Route::get('responder', function (){

    $ouvidoriaData = new StdClass();
    $ouvidoriaData->protocolo = 'dsamkm5343km43';
    $ouvidoriaData->descricao = 'Descrição qualquer que a pessoa colocou';
    $ouvidoriaData->nome = 'Moises abreu rodrigues';
    $ouvidoriaData->email = 'moisesabreurodrigues@gmail.com';



});

Route::post('ouvidoria', 'Admin\Ouvidoria\OuvidoriaController@store')->middleware('cors.ouvidoria');

Route::get('historico', 'Admin\Ouvidoria\OuvidoriaController@getOuvidoria')->middleware('cors.routes');
