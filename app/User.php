<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Log;


class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';
    
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    public function autenticaLdap($password){
        return $this->autenticaCredenciaisManual($this->username, $password);
    }

    private function autenticaCredenciaisManual($username, $password){
        if (empty($username) || empty($password)) return false;

        $ldap_host = env('LDAP_HOSTS');

        $ldap_usr_dom = '@academico.local';

        $ldap = ldap_connect($ldap_host);

        ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

        $verificaAutenticacao = @ldap_bind($ldap, $username . $ldap_usr_dom, $password);

        if($verificaAutenticacao){
            return (object) [
                'authenticated' => true,
                'name' => $this->recuperaDadosUsuarioLdap($username)
            ];
        }

        return (object) [
            'authenticated' => false,
            'name' => null
        ];
    }

    public function recuperaDadosUsuarioLdap($user){
        $connectionServer = ldap_connect(env('LDAP_HOSTS')) or die("Não foi possível conexão com Active Directory!");

        ldap_set_option($connectionServer, LDAP_OPT_PROTOCOL_VERSION, 3);

        ldap_set_option($connectionServer, LDAP_OPT_REFERRALS, 0);

        @ldap_bind($connectionServer, env('LDAP_USERNAME'), env('LDAP_PASSWORD'));

        $filter = "(&(objectclass=user)(samaccountname={$user}))";

        $busca  = @ldap_search($connectionServer, env('LDAP_BASE_DN'), $filter);

        $result = @ldap_get_entries($connectionServer, $busca);

        if ($result['count']) {
            return $result[0]['displayname'][0];
        }

        return null;
    }

}
