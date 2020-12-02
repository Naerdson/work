$(document).ready(function (e) {
    $("#acompanhamento").hide();

    $('#spinnerOuvidoria').hide();
    $('#spinnerAcompanhar').hide();

    $.ajax({
        method: "GET",
        url: "http://127.0.0.1:8000/api/recursos-ouvidoria",
        crossDomain: true,
        dataType: "json",
        beforeSend: function (request) {
            request.setRequestHeader("Authorization", "Bearer S0Z6OlHOWlEvshfphjQXTh9IvorDPoj7D1FigAjE");
        },
        success: function (response) {
            let campus = response.campus;
            let categorias_demandantes = response.categorias_demandantes;
            let categorias_demandas = response.categorias_demandas;
            
            campus.map(campus => {
                $("#campus_id").append($("<option></option>").text(campus.nome).val(campus.id));
            });

            categorias_demandantes.map(categorias => {
                $("#demandante_id").append($("<option></option>").text(categorias.nome).val(categorias.id));
            });

            categorias_demandas.map(categorias => {
                $("#categoria_id").append($("<option></option>").text(categorias.nome).val(categorias.id));
            });
        },
        error: function (error) {
            alert('Não foi possivel processar requisição');
        }
    });
    
});

$("#collapseAcompanhamento").click(function () {
    $("#ouvidoria").fadeOut();
    $("#collapseOuvidoria").removeClass("active");
    $("#acompanhamento").fadeIn("slow");
    $(this).addClass("active");

    $(":input", "#form-ouvidoria")
        .not(":button, :submit, :reset, :hidden")
        .val("")
        .removeAttr("selected");
});

$("#collapseOuvidoria").click(function () {
    $("#acompanhamento").fadeOut();
    $(this).addClass("active");
    $("#ouvidoria").fadeIn("slow");
    $("#collapseAcompanhamento").removeClass("active");

    $(":input", "#form-acompanhamento")
        .not(":button, :submit, :reset, :hidden")
        .val("")
        .removeAttr("selected");
});

$("#form-ouvidoria").submit(function (e) {
    e.preventDefault();

    $.ajax({
        method: "POST",
        url: "http://127.0.0.1:8000/api/ouvidoria",
        data: $(this).serialize(),
        crossDomain: true,
        dataType: "json",
        beforeSend: function (request) {
            request.setRequestHeader("Authorization", "Bearer S0Z6OlHOWlEvshfphjQXTh9IvorDPoj7D1FigAjE");
            $('#spinnerOuvidoria').show();
        },
        success: function (response) {

            setTimeout(() => {
                $('#spinnerOuvidoria').hide();

                $(":input", "#form-ouvidoria")
                    .not(":button, :submit, :reset, :hidden")
                    .val("")
                    .removeAttr("selected");

                $('#modalSucessoOuvidoria').modal({
                    show: true
                });
                document.getElementById('Numprotocolo').innerText = response.docs.protocolo;
            }, 1000);
        },
        error: function (error) {

            setTimeout(() => {
                $('#spinnerOuvidoria').hide();

                $('#modalErrorOuvidoria').modal({
                    show: true
                });
                document.getElementById('errorMsgOuvidoria').innerHTML = response.message;
            }, 1000);
        }
    });
});

$("#form-acompanhamento").submit(function (e) {
    e.preventDefault();

    $.ajax({
        method: "GET",
        url: "http://intranet.fametro/api/historico",
        data: $(this).serialize(),
        crossDomain: true,
        dataType: "json",
        beforeSend: function (request) {
            request.setRequestHeader("Authorization", "Bearer 6bPgJnrNRhLR9XEvdNIPbQdGEPrn4nnPM2ucvxkc");
            $('#spinnerAcompanhar').show();
        },
        success: function (response) {
            setTimeout(() => {
                $('#spinnerAcompanhar').hide();
                let arrayHistorico = response.docs.historico;

                document.getElementById('categoria_ocorrencia').innerText = `Categoria:   ${response.docs.ouvidoria.categoria}`;
                document.getElementById('setor').innerText = `Setor Responsável:   ${response.docs.ouvidoria.setor_responsavel}`;
                document.getElementById('status').innerText = `Status:   ${response.docs.ouvidoria.status}`;

                if (arrayHistorico.length > 0) {
                    for (const historico of arrayHistorico) {
                        renderHistoricos(historico);
                    }
                }
                $('#modalHistorico').modal({
                    show: true
                });

                $("#form-acompanhamento input").val('');

            }, 1000)

        },
        error: function (error) {
            $('#spinnerAcompanhar').hide();

            let input = $("#form-acompanhamento input");

            input.val("");
            alert(error.responseJSON.message);
            input.focus();
        }
    });
});

$('#modalHistorico').on('hide.bs.modal', function (event) {
    $('.historics').remove();
    $('.histo').remove();
})

function renderHistoricos(arrayHistoricos) {
    $('#timeline').append("<li class='historics'><div class='d-flex justify-content-between'><span class='text-uppercase'>" + arrayHistoricos.status + "</span><p>" + arrayHistoricos.data + "</p></div><p>Setor - " + arrayHistoricos.setor + "</p></li>")
}


function addFields(type, place, id){
    var container = document.getElementById("inputs");
    while (container.hasChildNodes()) {
        container.removeChild(container.lastChild);
    }
    var input = document.createElement("input");

    input.type = type;
    input.name = "contato";
    input.id = id;
    input.placeholder = place;
    input.required = true;
    input.style.top = "32px";
    input.style.position = "relative";
    container.appendChild(input);
}

$('select[id="tipo_contato"]').on('change', function() {
    if($(this).find('option:selected').val() == '2'){
        addFields("text", "00900000000", "WTaluno");
    }
    else{
        addFields("email", "Email", "email");
    }
});