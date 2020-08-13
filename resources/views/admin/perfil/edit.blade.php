@extends('admin.layouts.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header text-center" style="background: #44494D; color:white;">Dados do Usuário</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('perfil.update', auth()->user()->id) }}">
                        @if(Session::has('message') && Session::has('type'))
                            <div class="alert alert-{{ Session::get('type') }} text-center">{{ Session::get('message') }}</div>
                        @endif
                        @csrf
                        @method('PATCH')
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label for="role">Setor</label>
                                <select name="setor_id" class="form-control">
                                    <option disabled selected></option>
                                    @foreach($setores as $setor)
                                        @if($setor->id != 1)
                                            <option value="{{ $setor->id }}" <?= (auth()->user()->setor_id == $setor->id) ? 'selected' : '' ?>>{{ $setor->nome }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                </div>
                <div class="card-footer d-f d-justi-flex-end">
                    <button class="btn btn-success btn-sm" type="submit"><i class="fas fa-save"></i> Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
