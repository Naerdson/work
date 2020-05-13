<?php

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

Route::get('/', 'Auth\LoginController@index')->name('auth.login');
Route::post('/', 'Auth\LoginController@login')->name('login');

Route::prefix('admin')->group(function () {
    Route::get('ouvidoria/home', 'Admin\Ouvidoria\OuvidoriaController@index')->name('ouvidoria.home');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
    Route::put('ouvidoria/home', 'Admin\Ouvidoria\HistoricoController@forwardOccurrence')->name('ouvidoria.home.encaminhar');
    Route::put('ouvidoria/home/responder', 'Admin\Ouvidoria\HistoricoController@replyOccurrenceByEmail')->name('ouvidoria.home.responder.email');
    Route::put('ouvidoria/home/encerrar/{id}', 'Admin\Ouvidoria\HistoricoController@finishOccurrence')->name('ouvidoria.home.encerrar');
    Route::get('ouvidoria/historico/{id}', 'Admin\Ouvidoria\HistoricoController@getHistoric')->name('ouvidoria.historico');
    Route::get('usuario/home', 'Admin\Usuario\UsuarioController@index')->name('usuarios.home');
    Route::get('usuario/gerenciar/{id}', 'Admin\Usuario\UsuarioController@show')->name('usuarios.gerenciar');
    Route::patch('usuario/gerenciar/{id}', 'Admin\Usuario\UsuarioController@update')->name('usuario.gerenciar.atualizar');
});

Route::get('migrations', function(){

    try {
        DB::table('campus')->insert([
            ['nome' => 'Campus Conselheiro Estelita'],
            ['nome' => 'Campus Padre Ibiapina'],
            ['nome' => 'Campus Guilherme Rocha'],
            ['nome' => 'Campus Carneiro da Cunha'],
            ['nome' => 'Campus Maracanaú'],
            ['nome' => 'Campus Cascavel'],
            ['nome' => 'Campus Aldeota'],
            ['nome' => 'Campus Messejana'],
            ['nome' => 'Clínica Escola'],
            ['nome' => 'Complexo Odontológico'],
            ['nome' => 'NPJ (Núcleo de Práticas Jurídicas)'],
        ]);

        DB::table('setor')->insert([
            ['nome' => 'DEFAULT'],
            ['nome' => 'TECNOLOGIA DA INFORMAÇÃO'],
            ['nome' => 'RH / PESSOAL'],
            ['nome' => 'MARKETING'],
            ['nome' => 'DIRETORIA'],
            ['nome' => 'MANUTENÇÃO'],
            ['nome' => 'EAD - TUTORIA'],
            ['nome' => 'CURSO SERVIÇO SOCIAL'],
            ['nome' => 'PROCURADORIA EDUCACIONAL'],
            ['nome' => 'PLANEJAMENTO, DESENVOLVIMENTO E AVALIAÇÃO INSTITUCIONAL'],
            ['nome' => 'OUVIDORIA'],
            ['nome' => 'NÚCLEO DE ESTÁGIO'],
            ['nome' => 'TESOURARIA'],
            ['nome' => 'RECEPÇÃO'],
            ['nome' => 'CLINICA ESCOLA'],
            ['nome' => 'FINANCEIRO'],
            ['nome' => 'ATENDIMENTO AO ALUNO'],
            ['nome' => 'BIBLIOTECA'],
            ['nome' => 'EAD'],
            ['nome' => 'SUPERVISÃO ADMINISTRATIVA'],
            ['nome' => 'CURSO GESTÃO HOSPITALAR'],
            ['nome' => 'APOIO COORDENAÇÕES'],
            ['nome' => 'CURSO ENFERMAGEM'],
            ['nome' => 'CURSO DIREITO'],
            ['nome' => 'CURSO CIÊNCIAS CONTÁBEIS'],
            ['nome' => 'CURSO GESTÃO DE RECURSOS HUMANOS'],
        ]);

        DB::table('campus')->insert([
            ['nome' => 'Aluno(a)'],
            ['nome' => 'Professor(a)"'],
            ['nome' => 'Funcionário(a)'],
        ]);

        DB::table('ouvidoria_demandante')->insert([
            ['nome' => 'Aluno(a)'],
            ['nome' => 'Professor(a)'],
            ['nome' => 'Funcionário(a)'],
        ]);

        DB::table('ouvidoria_categoria')->insert([
            ['nome' => 'Reclamação'],
            ['nome' => 'Elogio'],
            ['nome' => 'Sugestão'],
            ['nome' => 'Informação'],
            ['nome' => 'Denúncia']
        ]);

        DB::table('ouvidoria_status')->insert([
            ['nome' => 'Aberto'],
            ['nome' => 'Encaminhado'],
            ['nome' => 'Respondido por email'],
            ['nome' => 'Concluido']
        ]);

        DB::table('nivel_usuario')->insert([
            ['nome' => 'Funcionário', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nome' => 'Administrador', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nome' => 'Super Administrador', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
        ]);

        return redirect()->route('auth.login')->with(['type' => 'success', 'message' => 'Migrations executadas com sucesso' ]);
    }
    catch (Exception $e){
        return redirect()->route('auth.login')->with(['type' => 'danger', 'message' => $e->getMessage() ]);
    }



});
