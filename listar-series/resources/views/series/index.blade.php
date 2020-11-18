@extends('layout')
@section ('cabecalho')
Lista de Cadastros
@endsection

@section('conteudo')
<form method="get">
    @csrf

    <div class="form-group">
        <div class="container">
            <div class="row">
                <label for="nome" class="">Nome</label>
                <div class="col-md">
                    <input type="text" class="form-control" name="nome" id="nome" placeholder="nome">
                </div>
                <div class="clo-md">
                    <button class="btn btn-primary mb-2">Adicionar Cadastro</button>
                </div>
            </div>
        </div>
    </div>

</form>
<br><br><br>
<hr>
<br><br><br>

@if(!empty($mensagem))
<div class="alert alert-sucess">
    {{ $mensagem }}
</div>

@endif
    <ul class="list-group">
        @foreach ($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-itens-center">
                {{$serie->nome}}
                @auth
                <form method="post" action="/series/{{$serie->id}}"
                       onsubmit="return confirm('Tem certeza que deseja remover {{addslashes($serie->nome)}} ?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sn">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
                @endauth
            </li>
        @endforeach
    </ul>
@endsection


