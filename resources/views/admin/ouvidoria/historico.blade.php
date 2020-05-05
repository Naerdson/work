@extends('admin.layouts.master')
@section('content')
    <div class="container-ouvidoria">
        <h3>Dados do histórico</h3>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Status</th>
                    <th scope="col">Setor</th>
                    <th scope="col">Usuário</th>
                    <th scope="col">Data</th>
                </tr>
            </thead>
            <tbody>
                @foreach($historics as $historico)
                    <tr>
                        <td>{{ $historico->status }}</td>
                        <td>{{ $historico->setor }}</td>
                        <td>{{ $historico->usuario }}</td>
                        <td>{{ date("d/m/Y H:i", strtotime($historico->criado_em)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
