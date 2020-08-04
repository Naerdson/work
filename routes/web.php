<?php

use App\Mail\ResponderOuvidoria;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;


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

Route::namespace('Auth')->group(function () {
    Route::get('/', 'LoginController@index')->name('auth.login');
    Route::post('/', 'LoginController@login')->name('login');
    Route::get('logout', 'LoginController@logout')->name('logout');
});

Route::prefix('admin')->group(function () {
    Route::namespace('Admin')->group(function () {
        
        Route::get('home', 'HomeController@index')->name('admin.home');
        Route::namespace('Ouvidoria')->group(function () {
            Route::get('ouvidoria/home', 'OuvidoriaController@index')->name('ouvidoria.home');
            Route::put('ouvidoria/encaminhar', 'HistoricoController@forwardOccurrence')->name('ouvidoria.home.encaminhar');
            Route::put('ouvidoria/responder', 'HistoricoController@replyOccurrenceByEmail')->name('ouvidoria.home.responder.email');
            Route::put('ouvidoria/encerrar/{id}', 'HistoricoController@finishOccurrence')->name('ouvidoria.home.encerrar');
            Route::get('ouvidoria/historico/{id}', 'HistoricoController@getHistoric')->name('ouvidoria.historico');
        });

        Route::namespace('UserManagement', function() {
            Route::get('usuario/home', 'UserManagementController@index')->name('usuarios.home');
            Route::get('usuario/gerenciar/{id}', 'UserManagementController@show')->name('usuarios.gerenciar');
            Route::patch('usuario/gerenciar/{id}', 'UserManagementController@update')->name('usuario.gerenciar.atualizar');
        }); 
    });
    
   
    
   

});

