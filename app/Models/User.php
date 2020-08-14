<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nome', 
        'usuario', 
        'email', 
        'setor_id', 
        'nivel_id'
    ];

    protected $hidden = [
        'usuario',
        'setor_id',
        'email',
        'nivel_id',
        'created_at',
        'updated_at'
    ];

    public function nivel()
    {
        return $this->hasOne(NivelUsuario::class, 'id', 'nivel_id');
    }

    public function authenticateLdap($password){
        return $this->_attemptAuthenticatedManuallyInAd($this->usuario, $password);
    }

    private function _attemptAuthenticatedManuallyInAd($username, $password){
        if (empty($username) || empty($password)) return false;

        $ldap_host = env('LDAP_HOSTS');

        $ldap_usr_dom = '@fametro.com.br';

        $ldap = ldap_connect($ldap_host);

        ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

        $verificaAutenticacao = @ldap_bind($ldap, $username . $ldap_usr_dom, $password);

        if($verificaAutenticacao){
            return (object) [
                'authenticated' => true,
                'user' => $this->_getUserDataInLdap($password)
            ];
        }

        return (object) [
            'authenticated' => false,
            'name' => null
        ];
    }

    public function _getUserDataInLdap($password){
        $connectionServer = ldap_connect(env('LDAP_HOSTS')) or die("Não foi possível conexão com Active Directory!");

        ldap_set_option($connectionServer, LDAP_OPT_PROTOCOL_VERSION, 3);

        ldap_set_option($connectionServer, LDAP_OPT_REFERRALS, 0);

        @ldap_bind($connectionServer, $this->usuario . env('LDAP_DOMAIN'), $password);

        $filter = "(&(objectclass=user)(samaccountname={$this->usuario}))";

        $busca  = @ldap_search($connectionServer, env('LDAP_BASE_DN'), $filter);

        $result = @ldap_get_entries($connectionServer, $busca);

        if($result){
            return (object) [
                'nome' => $result[0]['displayname'][0],
                'email' => @$result[0]["mail"][0]
            ];
        }

    }

}
