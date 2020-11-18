
@extends('layout')
@section('cabecalho')
          Adicionar Cadastro
@endsection

@section('conteudo')
<form method="post">
    @csrf
  <div class="form-group">
      <label for="nome" class="">Nome</label>
      <input type="text" class="form-control" name="nome" id="nome">
  </div>

    <button class="btn btn-primary">Adicionar Cadastro</button>
</form>

@endsection

