<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => \App\Policies\GerenciaUsuarioPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isSectorOmbudsman', function($user){
            return $user->setor_id = 'ouvidoria';
        });

        // Define portão para listar as ocorrencias e as informações  se o setor do usuário for igual ao da ouvidoria(11) ou se o
        // setor responsável pela ocorrencia for igual ao setor do usuário logado
        Gate::define('list-and-info-occurrence', function ($user, $ombudsman){
            return $user->setor_id == 19 || $ombudsman->setor_responsavel_id == $user->setor_id;
        });

        // Define portão para listar as opções de encaminhar e responder por email se o setor responsável pela ocorrencia for igual ao
        // usuário logado e se o status da ocorrência for menor ou igual a 3 (Respondido por email)
        Gate::define('forward-and-replyEmail-occurrence', function ($user, $ombudsman){
            return $ombudsman->setor_responsavel_id == $user->setor_id && $ombudsman->status_id <=3;
        });

        // Define portão para listar a opção de encerrar ocorrencia se o setor responsável pela ocorrencia for igual ao setor do usuário logado
        // E se o status da ocorrência for igual a 3 ( Respondido por email)
        Gate::define('finish-occurrence', function($user, $ombudsman){
           return $ombudsman->setor_responsavel_id == $user->setor_id && $ombudsman->status_id == 3;
        });

        // Define portão para listar a funcionalidade histórico se o
        // 1° Caso - setor do usuário logado for ouvidoria (11) e status da ocorrência for 2 (encaminhado)
        // 2° Caso - setor responsável pela ocorrencia for igual ao setor do usuário logado e status da ocorrencia for igual a 4 ( Concluido )
        Gate::define('historic-occurrence', function ($user, $ombudsman){
            return $user->setor_id == 19 && $ombudsman->status_id == 2 || $ombudsman->setor_responsavel_id == $user->setor_id && $ombudsman->status_id == 4;

        });

        Gate::define('list-paginate', function ($user, $ombudsman){
            foreach ($ombudsman as $ouvidoria){
                $result = $ouvidoria->setor_responsavel_id == $user->setor_id;
            }
            return $result;
        });
    }
}
