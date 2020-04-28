@component('mail::message')
    <h1>
        Prezado(a), me chamo {{ $usuario->name }}. Em relação a Ocorrencia aberta dia 28/04/2020 com a demanda Reclamação Segue abaixo trativa.
        <h3>{{ $ouvidoria->mensagem }}</h3>
    </h1>


@endcomponent
