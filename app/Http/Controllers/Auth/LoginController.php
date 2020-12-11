<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

            $validatedData = $request->validate([
                'usuario' => 'required',
                'password' => 'required',
            ]);

            $userInstance = User::firstOrCreate(['usuario' => $request->input('usuario'), 'nome' => 'Moises abreu rodrigues']);

            Auth::login($userInstance);

            return redirect('admin/ouvidoria/home');

            // $dataUser = (object) $request->post();

            // $userInstance = $this->user->firstOrNew(['usuario' => $dataUser->usuario]);

            // $autenticaUserLdap = $userInstance->authenticateLdap($dataUser->password);

            // if($autenticaUserLdap->authenticated){
            //         $userInstance->nome = $autenticaUserLdap->user->nome;
            //         $userInstance->email = $autenticaUserLdap->user->email;

            //         $userInstance->save();

            //         Auth::login($userInstance);

            //         if(is_null($userInstance['setor_id']) || $userInstance['setor_id'] == 1){
            //             return redirect('admin/perfil');
            //         }

            //         return redirect('admin/ouvidoria/home');
            // }

            return redirect('/', 303)->with(['type' => 'danger', 'message' => 'Usuário ou senha incorreto. Tente novamente.']);

        } catch (Exception $e) {
            return redirect()->back()->with(['type' => 'danger', 'message' => 'Error no servidor' . $e->getMessage()]);
        }
    }
    public function logout()
    {
        auth()->logout();

        Session()->flush();

        return redirect()->route('auth.login')->with(['type' => 'success', 'message' => 'Logout realizado com sucesso.' ]);
    }



}
