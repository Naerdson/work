<?php

use Illuminate\Support\Facades\Route;


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


Route::get('/series','SeriesgController@index')
    ->name('listar_series');
Route::get('/series/criar','SeriesgController@create')
    ->name('form_criar_serie');
Route::post('/series/criar','SeriesgController@store');
Route::delete('/series/{id}','SeriesgController@destroy');
/**Route::get('/sair',function(){
    \Illuminate\Support\Facades\Auth::logout();
    return redirect('entrar');
});
Route::get('/entrar', 'EntrarController@index');
Route::post('/entrar', 'EntrarController@entrar');
Route::get('/registrar', 'registroController@create');
Route::post('/registrar', 'registroController@store');
*/
Route::get('/sair',function(){
    \Illuminate\Support\Facades\Auth::logout();
    return redirect('/login');
});




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home',function() {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect('/series');
});
/**Route::get('/logout',function() {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect('home');
});
*/
