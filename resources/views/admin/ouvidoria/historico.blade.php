@extends('admin.layouts.master')
@section('content')
    <?php
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
    ?>
    <div>
        <h4 class="title-h">Histórico da ocorrência</h4>
    </div>

    <div class="row d-flex justify-content-start mt-3 mb-4">
        <div class="col-xl-12">
            <div class="card border-0">
                <div class="card-body">
                    <ul class="timeline">
                        @foreach($historicos as $historico)
                            <li>
                                <div class="d-flex justify-content-between">
                                    <span class="text-uppercase">{{ $historico['status']['nome'] }}</span>
                                    <p>{{ $historico['data_criacao'] }}</p>
                                </div>
                                <p>Setor - {{ $historico['setor']['nome'] }}</p>
                                <p>Usuário - {{ $historico['usuario']['nome'] }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('ouvidoria.home') }}"><button class="btn btn-info m-2"><i class="fas fa-arrow-circle-left"></i></button></a>
                </div>
            </div>
        </div>
    </div>
@endsection
