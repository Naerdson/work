<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Http\Controllers\Controller;
use App\NivelUsuario;
use App\Setor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class UserManagementController extends Controller
{
    private $user;

    public function __construct(User $usuario)
    {
        $this->user = $usuario;
    }

    public function index()
    {
        try {
            $usuariosCadastrados = User::all();

            if (Gate::denies('isAdmin', Auth::user()))
                throw new \DomainException('Você não tem permissão de administrador', 403);

            return view('admin.usuarios.home', compact('usuariosCadastrados'));

        }
        catch (\Exception $e){
            return redirect()->route('admin.home')->with(['message' => $e->getMessage(), 'type' => 'danger']);
        }


    }

    public function show($id)
    {
        $user = $this->user->findOrFail($id);
        $setores = Setor::all();
        $niveisUsuarios = NivelUsuario::all();

        return view('admin.usuarios.gerenciar', compact('user', 'setores', 'niveisUsuarios'));

    }

    public function update(Request $request, $id)
    {
        try {

            $userInstance = $this->user->findOrFail($id);

                if (!Gate::check('isAdmin', Auth::user())){

                    $request->offsetUnset('nivel_id');
                    $request->offsetUnset('setor_id');

                }

            $userInstanceUpdated = $userInstance->fill(array_merge($userInstance->toArray(), $request->post()));
            $userInstanceUpdated->update();

            return redirect()->back()->with(['message' => 'Dados atualizados com sucesso', 'type' => 'success']);

        }
        catch (\Exception $e){
            return redirect()->back()->with(['message' => $e->getMessage(), 'type' => 'danger']);
        }

    }

}
