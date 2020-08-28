$(function () {
    var demandasCtx = $("#demandas");
    var demandasChart = new Chart(demandasCtx);

$('.section-charts').ready(function () {
    getDemandas()
});

function getDemandas() {
    $.ajax({
        url: 'graficos',
        dataType: 'json',
        success: function (response) {
            var labels = Object.keys(response);
            var data = Object.values(response);
            createDemandasCharts(labels, data);
        }
    })
}

function createDemandasCharts(labels, data) {
    demandasChart.destroy();
    demandasChart = new Chart(demandasCtx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                label: 'Demandas',
                data: data,
                backgroundColor: ['#81B639','#ef7771','#00A593','#838383','#0071B5'],
            }],
        },
        options: {
            legend: {
                position: 'bottom'
            },
        }
    });
}
});