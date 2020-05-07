@extends('admin.layouts.master')
@section('titulo', 'Ouvidoria')
@section('content')
    <div class="d-flex justify-content-between">
        <h4 style="color: #6a7a8c; font-weight: 600; font-size: 21px;">Gerenciamento de Ouvidorias</h4>
        <button class="btn btn-success btn-sm"><i class="fas fa-file-pdf"></i> Gerar Relatório</button>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card">
                                <div class="box text-center bg-info">
                                    <h1 class="text-white" style="font-weight: 300;">{{ $listCountOuvidoria['total'] }}</h1>
                                    <h6 class="text-white">Total de ocorrências</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card">
                                <div class="box text-center bg-warning">
                                    <h1 class="text-white" style="font-weight: 300;">{{ $listCountOuvidoria['encaminhado'] }}</h1>
                                    <h6 class="text-white">Encaminhadas</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card">
                                <div class="box text-center bg-success">
                                    <h1 class="text-white" style="font-weight: 300;">{{ $listCountOuvidoria['concluido'] }}</h1>
                                    <h6 class="text-white">Concluídas</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3 col-xlg-3">
                            <div class="card">
                                <div class="box text-center bg-dark">
                                    <h1 class="text-white" style="font-weight: 300;">{{ $listCountOuvidoria['aberto'] }}</h1>
                                    <h6 class="text-white">Aberto</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(Session::has('message') && Session::has('type'))
                        <div class="alert alert-{{ Session::get('type') }} text-center mt-3">{{ Session::get('message') }}</div>
                    @endif
                    <div class="table-responsive mt-3">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-black-50">Status</th>
                                    <th class="text-black-50">Data de abertura</th>
                                    <th class="text-black-50">Protocolo</th>
                                    <th class="text-black-50">Categoria</th>
                                    <th class="text-black-50">Setor Responsável</th>
                                    <th class="text-black-50">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($ouvidorias as $ocorrencia)
                                @if(Auth::user()->setor_id == 4 ||$ocorrencia->setor_responsavel_id == Auth::user()->setor_id )
                                    <tr>
                                        <td class="text-dark">
                                            @if($ocorrencia->status == 'Encaminhado')
                                                <span class="span bg-warning">Encaminhado</span>
                                            @elseif($ocorrencia->status == 'Aberto')
                                                <span class="span bg-dark">Aberto</span>
                                            @elseif($ocorrencia->status == 'Concluido')
                                                <span class="span bg-success">Concluido</span>
                                            @endif
                                        </td>
                                        <td class="text-dark">{{ date("d/m/Y H:i", strtotime($ocorrencia->data)) }}</td>
                                        <td class="text-dark">{{ $ocorrencia->protocolo }}</td>
                                        <td class="text-dark">{{ $ocorrencia->categoria }}</td>
                                        <td class="text-dark">{{ $ocorrencia->setor_responsavel  }}</td>
                                        <td>
                                            @if($ocorrencia->setor_responsavel_id == Auth::user()->setor_id)
                                                @if($ocorrencia->status_id == 4)
                                                    <form method="post" action="{{ route('ouvidoria.home.encerrar', $ocorrencia->id) }}" style="display: inline" onsubmit="return confirm('Deseja encerrar esta ocorrência?');" >
                                                        @csrf
                                                        <input name="_method" type="hidden" value="PUT">
                                                        <button class="btn btn-info btn-sm">Encerrar Ocorrência</button>
                                                    </form>
                                                    <button type="button" class="btn btn-primary btn-sm" data-ocorrenciaid="{{ $ocorrencia->id }}" data-email="{{ $ocorrencia->email }}" data-toggle="modal" data-target="#modalResponderOcorrencia"><i class="fas fa-envelope"></i></button>
                                                    <button type="button" class="btn btn-warning btn-sm" data-ocorrenciaid="{{ $ocorrencia->id }}" data-toggle="modal" data-target="#modalEncaminharOcorrencia"><i class="fas fa-forward"></i></button>
                                                @elseif($ocorrencia->status_id == 3)
                                                    <a href="{{ route('ouvidoria.historico', $ocorrencia->id) }}"><button type="button" class="btn btn-info btn-sm"><i class="fas fa-history"></i></button></a>
                                                @else
                                                    <button type="button" class="btn btn-primary btn-sm" data-ocorrenciaid="{{ $ocorrencia->id }}" data-email="{{ $ocorrencia->email }}" data-toggle="modal" data-target="#modalResponderOcorrencia"><i class="fas fa-envelope"></i></button>
                                                    <button type="button" class="btn btn-warning btn-sm" data-ocorrenciaid="{{ $ocorrencia->id }}" data-toggle="modal" data-target="#modalEncaminharOcorrencia"><i class="fas fa-forward"></i></button>
                                                @endif
                                            @else
                                                <a href="{{ route('ouvidoria.historico', $ocorrencia->id) }}"><button type="button" class="btn btn-info btn-sm"><i class="fas fa-history"></i></button></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Modal Responder Ocorrencia-->
<div class="modal fade" id="modalResponderOcorrencia" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Responder Ocorrência</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('ouvidoria.home.responder.email')  }}">
                    @csrf
                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" name="ocorrencia_id" id="ocorrencia_id">
                    <input type="hidden" name="status_ocorrencia_id" value="4">
                    <div class="form-group">
                        <label for="mensagem">Responder para: </label>
                        <input type="text" class="form-control" name="email" id="email" />
                    </div>
                    <div class="form-group">
                        <label for="mensagem">Mensagem</label>
                        <textarea class="form-control" name="mensagem" id="mensagem" rows="6"></textarea>
                    </div>

            </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
        </div>
    </div>
</div>

<!-- Modal Encaminhar Ocorrencia-->
<div class="modal fade" id="modalEncaminharOcorrencia" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Encaminhar Ocorrência</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('ouvidoria.home.encaminhar') }}">
                @csrf
                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" name="ocorrencia_id" id="ocorrencia_id">
                    <input type="hidden" name="status_ocorrencia_id" value="2">
                    <div class="form-group">
                        <label for="setor">Setores</label>
                        <select name="setor_id" id="setor" class="form-control">
                            <option value="1">Técnologia da Informação</option>
                            <option value="2">Atendimento ao Aluno</option>
                            <option value="3">Financeiro</option>
                            <option value="4">Ouvidoria</option>
                        </select>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Encaminhar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#modalResponderOcorrencia').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var ocorrencia_id = button.data('ocorrenciaid'); // Extract info from data-* attributes
        var email_ocorrencia = button.data('email');

        var modal = $(this)
        modal.find('.modal-body #ocorrencia_id').val(ocorrencia_id)
        modal.find('.modal-body #email').val(email_ocorrencia)
    });

    $('#modalEncaminharOcorrencia').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var ocorrencia_id = button.data('ocorrenciaid'); // Extract info from data-* attributes

        var modal = $(this)
        modal.find('.modal-body #ocorrencia_id').val(ocorrencia_id)
    });


</script>
@endsection
