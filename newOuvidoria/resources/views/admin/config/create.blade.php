@extends('admin.layouts.master')
@section('titulo', 'Configurações')
@section('content')
    <div class="alert alert-info text-center">Ambiente responsável por criar tokens de API's para consumo externo</div>
    <div class="row">
        <div class="col-md-7">
            <div class="card">
            <div class="card-header text-center" style="background: #44494D; color:white;">Criar Token</div>
                <div class="card-body">
                    <form action="{{ route('config.store') }}" method="POST">
                    @csrf
                        <label for="titulo">Descrição</label>
                        <input type="text" name="descricao" class="form-control">   
                        
                        <label for="titulo" class="mt-2">Token</label>
                        <div class="d-flex">
                            <input type="text" name="token" class="form-control" id="input-token">
                            <button class="btn btn-sm btn-success ml-1" id="gerar-token">Gerar</button>
                        </div>
                </div>
                <div class="card-footer d-f d-justi-flex-end">
                    <a href="{{ route('admin.home') }}"><button class="btn btn-primary btn-sm m-l-10" type="button"><i class="fas fa-arrow-circle-left"></i> Voltar</button></a>
                    <button class="btn btn-sm btn-success" type="submit"><i class="fas fa-save"></i> Salvar</button>
                </div>  
                </form>
            </div>
        </div>
        <div class="col-md-5">
            @if(Session::has('message') && Session::has('type'))
                <div class="alert alert-{{ Session::get('type') }} text-center">{{ Session::get('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header text-center" style="background: #44494D; color:white;">Tokens criados</div>
                <div class="card-body">
                    @forelse ($tokens as $token)
                        <p class="font-weight-bold m-0">{{ $token->descricao }}</p>
                        <span class="mb-1">{{ $token->token }}</span>
                    @empty
                        <p>Não há tokens criados</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <script>
        $("#gerar-token").click(function (e) {
            e.preventDefault();

            $.ajax({
                method: "GET",
                url: '{{ route("config.generate.token") }}',
                success(data){
                    document.getElementById('input-token').value = data.token;
                } 
            });
        });
    </script>
@endsection