@extends('layout')
@section ('cabecalho')
<br>
Cadastrar
@endsection

@section('conteudo')

<form method="post">
    @csrf
    <div class="form-group">
        <div class="container">
            <div class="row">
                <label for="nome" style="margin:5px" class=""><b>Nome</b></label>
                <div class="col-xs-12 col-sm-6">
                    <input type="text" class="form-control" name="nome" id="nome" placeholder="nome">
                </div>
                <div>
                    <button class="btn btn-primary mb-2" style="margin:1px">Adicionar Cadastro</button>

                </div>
            </div>
        </div>
    </div>

</form>
<br><br><br>
<hr>
<br>
<h2><b>Lista de usuários cadastrados</b></h2>
<br><br>
<div class="container">
    <div class="row">
        <div class="col-sm-10"><b>Nome</b></div>
        <div class="col-sm-1"><b>Editar</b></div>
        <div class="col-sm-1"><b>Excluir</b></div>
    </div>
</div>
<br>

    <ul class="list-group">
        @foreach ($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-itens-center mb-2">
                <span id="nome-serie-{{ $serie->id }}">{{ $serie->nome }}</span>

                <div class="input-group w-50" hidden id="input-nome-serie-{{ $serie->id }}">
                    <input type="text" class="form-control" value="{{ $serie->nome }}">
                    <div class="input-group-append">
                            <button class="btn btn-primary" onclick="editarSerie({{ $serie->id }})">
                                <i class="fas fa-check"></i>
                            </button>
                        @csrf
                    </div>

                </div>
                <span class="d-flex">
                    <button class="btn btn-info btn-sm mr-1" onclick="toggleInput({{$serie->id}})">
                        <i class="fas fa-edit"></i>
                    </button>
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
                </span>
            </li>
        @endforeach
    </ul>

<script>
    function toggleInput(serieId) {
        const nomeSerieEl = document.getElementById(`nome-serie-${serieId}`);
        const inputSerieEl = document.getElementById(`input-nome-serie-${serieId}`);
        if (nomeSerieEl.hasAttribute('hidden')) {
            nomeSerieEl.removeAttribute('hidden');
            inputSerieEl.hidden = true;
        } else {
            inputSerieEl.removeAttribute('hidden');
            nomeSerieEl.hidden = true;
        }
    }

    function editarSerie(serieId) {
        let formData = new FormData();
        const nome = document
            .querySelector(`#input-nome-serie-${serieId} > input`)
            .value;
        const token = document
            .querySelector(`input[name="_token"]`)
            .value;
        formData.append('nome', nome);
        formData.append('_token', token);
        const url = `/series/${serieId}/editaNome`;
        fetch(url, {
            method: 'POST',
            body: formData
        }).then(() => {
            toggleInput(serieId);
            document.getElementById(`nome-serie-${serieId}`).textContent = nome;
        });
    }
</script>

@endsection


