<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unifametro - Ouvidoria</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh">
    <link href="src/css/style.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" defer="" crossorigin="anonymous" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" defer="" crossorigin="anonymous" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY"></script>
</head>
<body>
<header>
    <img alt="Logo Unifametro" src="src/img/logo-unifametro-01.png">
    <ul>
        <a href="http://www.unifametro.edu.br/" target="_blank">
            <li>
                Inicio
            </li>
        </a>
        <a href="http://www.unifametro.edu.br/contato/fale-conosco/" target="_blank">
            <li>
                Fale conosco
            </li>
        </a>
        <li>
            <a href="http://portal.fametro.com.br/" target="_blank">
                <i class="fa fa-graduation-cap"></i>
                PORTAL ACADÊMICO
            </a>
        </li>
    </ul>
</header>
<section>
    <h1>OUVIDORIA UNIFAMETRO</h1>
    <p class="text-dark">Prezado(a), Procurando fazer o melhor por você, a Ouvidoria da UNIFAMETRO quer saber sua opinião sobre nossos serviços. <br> Preencha este formulário para registrar suas opiniões. Se preferir, identifique-se e deixe seu contato</p>
    <div class="container">
        <div class="opcoes-ouvidoria">
            <a class="active" id="collapseOuvidoria" href="#">NOVA OUVIDORIA</a>
            <a id="collapseAcompanhamento" href="#">ACOMPANHAR ATENDIMENTO</a>
        </div>
        <div id="ouvidoria">
            <form id="form-ouvidoria">
                <div class="row">
                    <div class="col">
                        <label for="nome">Nome (opcional)</label>
                        <input name="nome" type="text">
                    </div>
                    <div class="col">
                        <label class="required" for="demandante_id">Demandante</label>
                        <select name="demandante_id" id="demandante_id" required="">
                            <option disabled="" selected="">Selecione o demandante</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label class="required" for="categoria_id">Tipo de Demanda</label>
                        <select name="categoria_id" id="categoria_id" required="">
                            <option disabled="" selected="">Selecione a demanda</option>
                        </select>
                    </div>
                    <div class="col">
                        <label class="required" for="campus_id">Campus</label>
                        <select name="campus_id" id="campus_id" required="">
                            <option disabled="" selected="">Selecione o campus</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label class="required" for="descricao">Descrição</label>
                        <textarea name="descricao" id="descricao" required="" placeholder="Descreva aqui o motivo">Descreva aqui o motivo</textarea>
                    </div>
                </div>
                <div class="row form-row-teste">
                    <div class="col">
                        <label class="required" for="inputState">Contato para retorno</label>
                        <select name="tipo_contato_id" id="tipo_contato">
                            <option disabled="" selected="">Informe o tipo de contato</option>
                        </select>
                    </div>
                    <div class="form-row-teste col" id="inputs">

                    </div>
                </div>
                <button type="submit">
                    ENVIAR
                    <span class="spinner-border spinner-border-sm" id="spinnerOuvidoria"></span>
                </button>
            </form>
        </div>

        <div id="acompanhamento">
            <form id="form-acompanhamento">
                <div class="row">
                    <div class="col">
                        <label class="required" for="nome">N° do protocolo</label>
                        <input name="protocolo" required="" type="text">
                    </div>
                </div>
                <button class="button-block" type="submit">
                    Acompanhar demanda
                    <span class="spinner-border spinner-border-sm" id="spinnerAcompanhar"></span>
                </button>
            </form>
        </div>
    </div>
</section>

<!-- Modal com os históricos da ocorrência - INICIO -->

<div class="modal fade" id="modalHistorico" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Histórico da ocorrência</h4>
            </div>
            <div class="modal-body">
                <p id="categoria_ocorrencia" style="padding-left: 1em;"></p>
                <p id="setor" style="padding-left: 1em;"></p>
                <p id="status" style="padding-left: 1em;"></p>
                <div class="card border-0">
                    <div class="card-body p-0">
                        <ul class="timeline" id="timeline">

                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-dark" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal com os históricos da ouvidoria - INICIO -->


<!-- Modal com mensagem de sucesso ao abrir a ouvidoria - INICIO -->

<div class="modal fade" id="modalSucessoOuvidoria" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: rgb(0, 200, 81);">
                <h4 class="text-white" style="font-weight: 300;">Ouvidoria aberta com sucesso</h4>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <i class="fas fa-check" style="color: rgb(40, 167, 69); font-size: 4em;"></i>
                </div>
                <p class="text-center mt-4">Acompanhe o andamento da ocorrência através do número de protocolo.</p>
                <h3 class="text-center mt-2"><strong id="Numprotocolo"></strong></h3>
            </div>
            <div class="modal-footer">
                <button class="btn btn-dark" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal com mensagem de sucesso ao abrir a ouvidoria - FIM -->

<!-- Modal com mensagem de ERROR ao abrir a ouvidoria - INICIO -->

<div class="modal fade" id="modalErrorOuvidoria" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background: rgb(255, 53, 71);">
                <h4 class="text-white" style="font-weight: 300;">Error ao processar a requisição</h4>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center mt-3">
                    <i class="fas fa-times" style="color: rgb(255, 53, 71); font-size: 4em;"></i>
                </div>
                <p class="text-center mt-4" id="errorMsgOuvidoria"></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-dark" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal com mensagem de sucesso ao ERROR a ouvidoria - FIM -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" crossorigin="anonymous" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"></script>
<script src="src/js/script.js"></script>

</body></html>
