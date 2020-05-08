<?php

namespace App\Http\Controllers\Admin\Usuario;

use App\Http\Controllers\Controller;
use App\Setor;
use App\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    private $user;

    public function __construct(User $usuario)
    {
        $this->user = $usuario;
    }

    public function index()
    {
        $usuariosCadastrados = $this->user->all();

        return view('admin.usuarios.home', compact('usuariosCadastrados'));
    }

    public function show($id)
    {
        $user = $this->user->findOrFail($id);
        $setores = Setor::all();

        return view('admin.usuarios.gerenciar', compact('user', 'setores'));

    }

}
