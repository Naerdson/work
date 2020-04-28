@component('mail::message')
    <h1>
        Prezado(a), me chamo {{ $data->nome }}. Em relação a Ocorrencia aberta dia 28/04/2020 com a demanda Reclamação Segue abaixo trativa.
        <h3>{{ $data->descricao }}</h3>
    </h1>

    
@endcomponent
