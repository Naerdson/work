<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exeception;
use App\User;
use Auth;

class LoginController extends Controller
{
    private $user = null;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function index(){
        return view('auth.login');
    }
    public function login(Request $request){
        try {
            // vazer a validação

            
            $dataUser = (object) $request->post();
            
            $userInstance = $this->user->firstOrNew(['username' => $dataUser->username]);

            $autenticaUserLdap = $userInstance->autenticaLdap($dataUser->password);
            if($autenticaUserLdap->authenticated){
                $userInstance->name = $autenticaUserLdap->name;
                $userInstance->save();
                Auth::login($userInstance);
                return view('admin.home');
            }
            return redirect()->back()->with(['type' => 'danger', 'message' => 'Não foi possível autenticar o usuário. Tente novamente.']);
        } catch (Exeception $e) {
            return $e->getMessage();
        }
    }
    public function logout()
    {
        auth()->logout();

        Session()->flush();

        return redirect()->route('auth.login')->with(['type' => 'success', 'message' => 'Logout realizado com sucesso.' ]);
    }



}
