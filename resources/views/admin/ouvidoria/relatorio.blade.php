@extends('admin.layouts.master')
@section('titulo', 'Relatório Mensal')
@section('content')

    <div class="bg-light mb-2 p-2 d-flex justify-content-between align-items-center">
        <a href="/admin/ouvidoria/gerar-relatorio-mensal?mes={{ app('request')->input('mes') }}">
            <button type="button" class="btn btn-info btn-sm">
                <i class="fas fa-file-pdf"></i> 
                Imprimir relatório
            </button>
        </a>

        <form action="{{ route('ouvidoria.relatorio') }}" class="d-flex">
            <select name="mes" class="form-control mr-2">
                <option value="0" disabled="disabled" selected="selected">Filtre pelo mês</option>
                @foreach ($meses as $keyMonth => $month)
                    <option value="{{ $keyMonth }}" <?= ($keyMonth == app('request')->input('mes') ? "selected" : "") ?>>{{ $month }}</option>
                @endforeach
            </select>
            <button class="btn btn-sm btn-primary"><i class="fas fa-search"></i></button>
        </form>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <div id="piechart-demandas"></div>
        </div>

        <div class="col-md-6">
            <div id="piechart-demandantes"></div>
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
                        <td>{{ $relatorio->nome }}</td>
                        <td>{{ $relatorio->qtd_demandante_especifico }}</td>
                        <td>{{ $relatorio->porcentagem_individual }}%</td>
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
                        <td>{{ $relatorio->nome }}</td>
                        <td>{{ $relatorio->qtd_categoria_especifica }}</td>
                        <td>{{ $relatorio->porcentagem_individual }}%</td>
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
    <script type="text/javascript">
            function init() {
                google.load("visualization", "44", {packages:["corechart"]});
                var interval = setInterval(function () {
                if (google.visualization !== undefined && google.visualization.DataTable !== undefined 
                    && google.visualization.PieChart !== undefined) {
                    clearInterval(interval);
                    window.status = 'ready';
                    drawChart();
                    drawChart2();
                }
                }, 100);
            }

            function drawChart() {
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Element');
                data.addColumn('number', 'Percentage');
                data.addRows([
                    @foreach($graficos['demandas'] as $key => $value)
                        @if ($key  != 'Demandas')
                            ['{{ $key }}', {{ $value }}],
                        @endif
                    @endforeach
                ]);

                var chart = new google.visualization.PieChart(document.getElementById('piechart-demandas'));
                chart.draw(data, {
                    title: 'Categoria Demandas',
                    backgroundColor: 'transparent',
                    width: '100%',
                    height: 400,
                    titleTextStyle: {
                        fontSize: 18
                    },
                    chartArea: {
                        width: '80%', 
                        height: '80%'
                    },
                    legend: {
                        textStyle: {
                            fontSize: 14
                        }
                    },
                    tooltip: {
                        textStyle: {
                            fontSize: 13,
                        }
                    }
                });
            }

            function drawChart2() {
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Element');
                data.addColumn('number', 'Percentage');
                data.addRows([
                    @foreach($graficos['demandantes'] as $key => $value)
                        @if ($key  != 'Demandantes')
                            ['{{ $key }}', {{ $value }}],
                        @endif
                    @endforeach
                ]);

                var chart2 = new google.visualization.PieChart(document.getElementById('piechart-demandantes'));
                chart2.draw(data, {
                    title: 'Categoria Demandantes',
                    backgroundColor: 'transparent',
                    width: '100%',
                    height: 400,
                    titleTextStyle: {
                        fontSize: 18
                    },
                    chartArea: {
                        width: '80%', 
                        height: '80%'
                    },
                    legend: {
                        textStyle: {
                            fontSize: 14
                        }
                    },
                    tooltip: {
                        textStyle: {
                            fontSize: 13,
                        }
                    }
                });
            }
        </script>
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
