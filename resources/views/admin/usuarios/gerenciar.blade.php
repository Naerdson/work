@extends('admin.layouts.master')
@section('titulo', 'Gerenciar')
@section('content')

<div class="row">
    <!-- <div class="col-md-4">
        <div class="card">
            <div class="card-header text-center" style="background: #44494D; color:white;">Foto de Perfil</div>
            <div class="card-body">
                <form method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="d-flex justify-content-center" id="img-user">
                        <img src="{{ asset('img/no_avatar.jpg') }}" name="photo_user" class="img-perfil-user align-self-center" id="user-foto" alt="Foto de perfil">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-dark" type="submit"><i class="fas fa-sync-alt"></i></button>
                    </div>
                    @error('photo_user')
                        <div class="alert alert-danger alert-danger-form">{{ $message }}</div>
                    @endif
                </form>
            </div>
        </div>
    </div> -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center" style="background: #44494D; color:white;">Dados do Usuário</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('usuario.gerenciar.atualizar', $user->id) }}">
                        @if(Session::has('message') && Session::has('type'))
                            <div class="alert alert-{{ Session::get('type') }} text-center">{{ Session::get('message') }}</div>
                        @endif
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="nome">Nome Completo</label>
                                <input type="text" name="nome" class="form-control" value="{{ $user->nome }}">
                            </div>
                            <div class="col-md-6">
                                <label for="username">Email</label>
                                <input type="text" name="email" class="form-control" value="{{ $user->email }}">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label for="role">Nível de usuário</label>
                                <select name="nivel_id" class="form-control" @cannot('isAdmin', $user) disabled @endcannot>
                                    <option disabled selected></option>
                                    @foreach($niveisUsuarios as $nivel)
                                        <option value="{{ $nivel->id }}" <?= ($user->nivel_id == $nivel->id) ? 'selected' : '' ?>>{{ $nivel->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="role">Setor</label>
                                <select name="setor_id" class="form-control" @cannot('isAdmin', $user) disabled @endcannot>
                                    <option disabled selected></option>
                                    @foreach($setores as $setor)
                                        @if($setor->id != 1 && $setor->id != 28)
                                            <option value="{{ $setor->id }}" <?= ($user->setor_id == $setor->id) ? 'selected' : '' ?>>{{ $setor->nome }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                </div>
                <div class="card-footer d-f d-justi-flex-end">
                    <a href="{{ route('usuarios.home') }}"><button class="btn btn-primary m-l-10 btn-sm" type="button"><i class="fas fa-arrow-circle-left"></i> Voltar</button></a>
                    <button class="btn btn-success btn-sm" type="submit"><i class="fas fa-save"></i> Salvar</button>
                </div>
                </form>

            </div>
        </div>
    </div>
    </div>

@endsection
