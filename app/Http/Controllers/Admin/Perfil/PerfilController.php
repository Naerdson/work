<?php

namespace App\Http\Controllers\Admin\Perfil;

use App\Http\Controllers\Controller;
use App\Models\Setor;
use App\Models\User;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function edit()
    {
        $setores = Setor::all();
        return view('admin.perfil.edit', compact('setores'));
    }

    public function update(Request $request, $id)
    {
        $userInstance = User::find($id);
        $userInstanceUpdated = $userInstance->fill(array_merge($userInstance->toArray(), $request->post()));
        $userInstanceUpdated->update();

        return redirect('admin/ouvidoria/home')->with(['type' => 'success', 'message' => 'Usuário alterado com sucesso']);
    }
}
