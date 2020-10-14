@extends('admin.pdf.layout')

@section('content')
    @section('title')
        <h4 class="text-center text-uppercase mt-3 mb-4">RELATÓRIO OUVIDORIA - 
            @foreach ($meses as $keyMonth => $month)
                @if ($mes == $keyMonth)
                    {{ $month }}
                @endif
            @endforeach
        </h4>
    @endsection
    
    <div class="row">
        <div class="col-2">
            <div id="myPieChart"></div>
        </div>
            
        <div class="col-2">
            <div id="myPieChart2"></div>
        </div>
    </div>

    <div class="content mt-3">
        <div class="mb-2">
            <h5>DEMANDANTES</h5>
        </div>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Categoria</th>
                    <th>Quantidade</th>
                    <th>Porcentagem</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['DEMANDANTES'] as $relatorio)
                    <tr>
                        <td>{{ $relatorio->nome }}</td>
                        <td>{{ $relatorio->qtd_demandante_especifico }}</td>
                        <td>{{ $relatorio->porcentagem_individual }}%</td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <div class="mb-2">
            <h5>DEMANDAS</h5>
        </div>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Categoria</th>
                    <th>Quantidade</th>
                    <th>Porcentagem</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['DEMANDAS'] as $relatorio)
                    <tr>
                        <td>{{ $relatorio->nome }}</td>
                        <td>{{ $relatorio->qtd_categoria_especifica }}</td>
                        <td>{{ $relatorio->porcentagem_individual }}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mb-2 mt-4">
            <h5>RECLAMAÇÕES</h5>
        </div>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Demandante</th>
                    <th>Descrição</th>
                    <th>Campus</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['RECLAMACOES'] as $reclamacao)
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

                var chart = new google.visualization.PieChart(document.getElementById('myPieChart'));
                chart.draw(data, {
                    title: 'Categoria Demandas',
                    width: 800,
                    height: 450,
                    titleTextStyle: {
                        fontSize: 17
                    },
                    backgroundColor: 'transparent',
                    chartArea: {
                        top: 60,
                        width: '70%', 
                        height: '70%'
                    },
                    legend: {
                        position: 'bottom',
                        textStyle: {
                            fontSize: 13
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

                var chart2 = new google.visualization.PieChart(document.getElementById('myPieChart2'));
                chart2.draw(data, {
                    title: 'Categoria Demandantes',
                    width: 800,
                    height: 450,
                    backgroundColor: 'transparent',
                    titleTextStyle: {
                        fontSize: 17
                    },
                    chartArea: {
                        top: 80,
                        width: '70%', 
                        height: '70%'
                    },
                    legend: {
                        position: 'bottom',
                        textStyle: {
                            fontSize: 13
                        }
                    }
                });
            }
        </script>
    @endpush
@endsection