@extends('admin.layouts.master')
@section('titulo', 'Gerenciar')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header text-center" style="background: #44494D; color:white;">Foto de Perfil</div>
                <div class="card-body">
                    @if(Session::has('message') && Session::has('type'))
                        <div class="alert alert-{{ Session::get('type') }}">{{ Session::get('message') }}</div>
                    @endif
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
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center" style="background: #44494D; color:white;">Dados do Usuário</div>
                <div class="card-body">
                    <form method="POST" action="">
                        @if(Session::has('messageUpdatePermission') && Session::has('messageUpdatePermissionType'))
                            <div class="alert alert-{{ Session::get('messageUpdatePermissionType') }} text-center">{{ Session::get('messageUpdatePermission') }}</div>
                        @endif
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="nome">Nome Completo</label>
                                <input type="text" name="name" class="form-control" value="{{ $user->nome }}" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="username">Usuário</label>
                                <input type="text" name="username" class="form-control" value="{{ $user->usuario }}" disabled>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label for="role">Setor</label>
                                <select name="setor_id" class="form-control">
                                    <option disabled selected></option>
                                    @foreach($setores as $setor)
                                        <option value="{{ $setor->id }}" <?= (Auth::user()->setor_id == $setor->id) ? 'selected' : '' ?>>{{ $setor->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                </div>
                <div class="card-footer d-f d-justi-flex-end">
                    <a href="{{ route('usuarios.home') }}"><button class="btn btn-primary m-l-10" type="button"><i class="fas fa-arrow-circle-left"></i> Voltar</button></a>
                    <button class="btn btn-success" type="submit"><i class="fas fa-save"></i> Salvar</button>
                </div>
                </form>

            </div>
        </div>
    </div>
    </div>

@endsection
