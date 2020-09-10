@extends('admin.layouts.master')
@section('content')

    <div class="bg-light mb-2 p-2 d-flex justify-content-between align-items-center">
        <a href="{{ route('ouvidoria.gerar.relatorio') }}">
            <button type="button" class="btn btn-info btn-sm">
                <i class="fas fa-file-pdf"></i> 
                Imprimir relatório
            </button>
        </a>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <canvas id="demandas"></canvas>
        </div>

        <div class="col-md-6">
            <canvas id="demandantes"></canvas>
        </div>
    </div>

    <div class="bg-light mt-4 p-2 d-flex justify-content-between align-items-center" 
        style="cursor: pointer;" 
        data-toggle="collapse" 
        href="#collapseDemandantes" 
        aria-expanded="false" 
        aria-controls="collapseDemandantes"
    >
        <h5 class="font-weight-bold">
            Demandantes
        </h5>
        <i class="fas fa-caret-down mr-3" style="font-size: 30px;" id="icon-dropdownDemandantes"></i>
    </div>

    <div class="collapse" id="collapseDemandantes">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Categoria</th>
                    <th>Quantidade</th>
                    <th>Porcentagem</th>
                </tr>
            </thead>
            <tbody>
                @foreach($relatorios['DEMANDANTES'] as $relatorio)
                    <tr>
                        <td>{{ $relatorio->DEMANDANTES }}</td>
                        <td>{{ $relatorio->QTD_DEMANDANTE }}</td>
                        <td>{{ $relatorio->PORCENTAGEM }}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="bg-light mt-4 p-2 d-flex justify-content-between align-items-center" 
        style="cursor: pointer;" 
        data-toggle="collapse" 
        href="#collapseDemandas" 
        aria-expanded="false" 
        aria-controls="collapseDemandas"
    >
        <h5 class="font-weight-bold">
            Demandas
        </h5>
        <i class="fas fa-caret-down mr-3" style="font-size: 30px;" id="icon-dropdownDemandas"></i>
    </div>
    
    <div class="collapse" id="collapseDemandas">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Categoria</th>
                    <th>Quantidade</th>
                    <th>Porcentagem</th>
                </tr>
            </thead>
            <tbody>
                @foreach($relatorios['DEMANDAS'] as $relatorio)
                    <tr>
                        <td>{{ $relatorio->CATEGORIAS }}</td>
                        <td>{{ $relatorio->QTD_CATEGORIA }}</td>
                        <td>{{ $relatorio->PORCENTAGEM }}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="bg-light mt-4 p-2 d-flex justify-content-between align-items-center" 
        style="cursor: pointer;" 
        data-toggle="collapse" 
        href="#collapseReclamacao" 
        aria-expanded="false" 
        aria-controls="collapseReclamacao"
    >
        <h5 class="font-weight-bold">
            Reclamações
        </h5>
        <i class="fas fa-caret-down mr-3" style="font-size: 30px;" id="icon-dropdown"></i>
    </div>

    <div class="collapse" id="collapseReclamacao">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Demandante</th>
                    <th>Descrição</th>
                    <th>Campus</th>
                </tr>
            </thead>
            <tbody>
                @foreach($relatorios['RECLAMACOES'] as $reclamacao)
                    <tr>
                        <td>{{ $reclamacao->demandante->nome }}</td>
                        <td>{{ $reclamacao->descricao }}</td>
                        <td>{{ $reclamacao->campus->nome }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@push('scripts')
    <script src="{{ asset('js/chart.min.js') }}"></script>
    <script src="{{ asset('js/charts-ouvidoria.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.4.0/dist/chartjs-plugin-datalabels.min.js"></script>
    <script>
        $("#collapseDemandantes").on('show.bs.collapse', function () {
            $('#icon-dropdownDemandantes').attr('class', 'fas fa-caret-up mr-3')
        });

        $("#collapseDemandantes").on('hide.bs.collapse', function () {
            $('#icon-dropdownDemandantes').attr('class', 'fas fa-caret-down mr-3')
        });

        $("#collapseDemandas").on('show.bs.collapse', function () {
            $('#icon-dropdownDemandas').attr('class', 'fas fa-caret-up mr-3')
        });

        $("#collapseDemandas").on('hide.bs.collapse', function () {
            $('#icon-dropdownDemandas').attr('class', 'fas fa-caret-down mr-3')
        });

        $("#collapseReclamacao").on('show.bs.collapse', function () {
            $('#icon-dropdown').attr('class', 'fas fa-caret-up mr-3')
        });

        $("#collapseReclamacao").on('hide.bs.collapse', function () {
            $('#icon-dropdown').attr('class', 'fas fa-caret-down mr-3')
        });
    </script>
@endpush
@endsection
