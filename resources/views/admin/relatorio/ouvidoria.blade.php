<?php
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
    <title>Document</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap");

        @page {
            margin: 70px 0;
        }

        * {
            margin: 0;
            padding: 0;
            outline: 0;
            box-sizing: border-box;
        }
        
        body {
            font: 400 14px Roboto, sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        .header {
            left: 0;
            right: 0;
            width: 100%;
            text-align: center;
            padding-top: 10px;   
        }
        .header img {
            margin-top: 10px;
        }

        .header .titulo-relatorio {
            border: none;
            margin: 20px 12px 0 12px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .content {
            margin: 30px 25px 0 25px;
        }

        table {
            width: 100%;
            border: 1px solid #000;
            margin: 0;
            padding: 0;
        }
        
        table, th, td {
            border: 1px solid #000;
            border-collapse: collapse;
            text-align: center;
        }

    </style>
</head>

<body>
    <div class="header">
        <img src="{{ asset('img/logo_uni_relatorio.png') }}" style="width: 30%">
        <p style="font-size: 23px;  font-weight: bold; margin:0;">Centro Universitário Fametro</p>
        <span style="font-size: 13px;">RUA CONSELHEIRO ESTELITA, 500 - BAIRRO: CENTRO - CEP: 60010260 - FORTALEZA - CE - CNPJ: 03.884.793/001-47</span>
        <h2 class="titulo-relatorio">RELATÓRIO OUVIDORIA - {{ strftime('%B', strtotime('today')) }}</h2>
    </div>
    <div class="content">
        <div style="margin-bottom: 5px;">
            <span><b>DEMANDANTES</b></span>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Categoria</th>
                    <th>Quantidade</th>
                    <th>Porcentagem</th>
                </tr>
            </thead>
            <tbody>
                @foreach($report['DEMANDANTES'] as $relatorio)
                    <tr>
                        <td>{{ $relatorio->DEMANDANTES }}</td>
                        <td>{{ $relatorio->QTD_DEMANDANTE }}</td>
                        <td>{{ str_replace(".", "", substr(round($relatorio->PORCENTAGEM),0, 3)) }}%</td>
                    </tr>
                @endforeach
                <tr>
                    <td><b>Totais</b></td>
                    <td><b>{{$report['DEMANDANTES'][0]->TOTAL_OCORRENCIAS}}</b></td>
                    <td><b>{{ str_replace(".", "", substr($report['DEMANDANTES'][0]->PORCENTAGEM_TOTAL,0, 3)) }}%</b></td>
                </tr>
            </tbody>
        </table>

        <div style="margin-bottom: 5px; margin-top: 10px;">
            <span><b>DEMANDAS</b></span>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Categoria</th>
                    <th>Quantidade</th>
                    <th>Porcentagem</th>
                </tr>
            </thead>
            <tbody>
                @foreach($report['DEMANDAS'] as $relatorio)
                    <tr>
                        <td>{{ $relatorio->CATEGORIAS }}</td>
                        <td>{{ $relatorio->QTD_CATEGORIA }}</td>
                        <td>{{ str_replace(".", "", substr(round($relatorio->PORCENTAGEM),0, 3)) }}%</td>
                    </tr>
                @endforeach
                <tr>
                    <td><b>Totais</b></td>
                    <td><b>{{$report['DEMANDANTES'][0]->TOTAL_OCORRENCIAS}}</b></td>
                    <td><b>{{ str_replace(".", "", substr($report['DEMANDAS'][0]->PORCENTAGEM_TOTAL,0, 3)) }}%</b></td>
                </tr>
            </tbody>
        </table>

        <div style="margin-bottom: 5px; margin-top: 10px;">
            <span><b>RECLAMAÇÕES</b></span>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Demandante</th>
                    <th>Descrição</th>
                    <th>Campus</th>
                </tr>
            </thead>
            <tbody>
                @foreach($report['RECLAMACOES'] as $reclamacao)
                    <tr>
                        <td>{{ $reclamacao->DEMANDANTE }}</td>
                        <td>{{ $reclamacao->DESCRICAO }}</td>
                        <td>{{ $reclamacao->CAMPUS }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>