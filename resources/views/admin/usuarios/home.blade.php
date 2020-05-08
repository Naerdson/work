@extends('admin.layouts.master')
@section('titulo', 'Gerenciamento de usuários')
@section('content')
    <h4 class="title-h">Gerenciamento de Usuarios</h4>
    <div class="row row-cols-1 row-cols-md-4 p-0">
        @foreach($usuariosCadastrados as $usuario)
            <div class="box">
                <div class="box_content d-flex justify-content-center flex-column">
                    <img src="{{ asset('img/no_avatar.jpg') }}" class="img-perfil-user align-self-center" alt="Foto de perfil">
                    <h6 class="align-self-center text-uppercase">{{ $usuario->nome }}</h6>
                    <p class="align-self-center"><i class="fas fa-user"></i> {{ $usuario->usuario }}</p>
                    <a href="{{ route('usuarios.gerenciar', $usuario->id) }}" class="align-self-center""><button class="btn btn-outline-primary"><i class="fas fa-user-edit"></i> Gerenciar Usuário</button></a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
