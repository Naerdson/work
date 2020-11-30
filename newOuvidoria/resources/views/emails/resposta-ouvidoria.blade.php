@component('mail::message')

    <p>
        <strong>
            <p>Prezado(a), me chamo {{ $usuario->nome }}, estou entrando em contato para tratar a demanda aberta no dia {{ $ouvidoria->data2}}.</p>
            <p>Número do protocolo: {{ $ouvidoria->protocolo }}</p>
            <p>Tratativa do atendimento:</p>
        </strong>
    {{ $mensagem['mensagem'] }}
    </p>


@endcomponent
