$(function () {
    var demandasCtx = $("#demandas");
    var demandasChart = new Chart(demandasCtx);

    var demandantesCtx = $("#demandantes");
    var demandantesChart = new Chart(demandantesCtx);

    $('.section-charts').ready(function () {
        getDemandas()
        getDemandantes()
    });

    function getDemandas() {
        $.ajax({
            url: 'graficos',
            dataType: 'json',
            success: function (response) {
                var labels = Object.keys(response.demandas);
                var data = Object.values(response.demandas);
                createDemandasCharts(labels, data);
            }
        });
    }

    function getDemandantes() {
        $.ajax({
            url: 'graficos',
            dataType: 'json',
            success: function (response) {
                var labels = Object.keys(response.demandantes);
                var data = Object.values(response.demandantes);
                createDemandantesCharts(labels, data);
            }
        });
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
                    backgroundColor: ['#81B639','#ef7771','#00A593'],
                }],
            },
            options: {
                legend: {
                    position: 'bottom',
                    labels: {
                        fontSize: 14,
                        render: 'percentage',
                        fontColor: function (data) {
                          var rgb = hexToRgb(data.dataset.backgroundColor[data.index]);
                          var threshold = 140;
                          var luminance = 0.299 * rgb.r + 0.587 * rgb.g + 0.114 * rgb.b;
                          return luminance > threshold ? 'black' : 'white';
                        },
                        precision: 2
                    }
                },
                title: {
                    fontSize: 20,
                    display: true,
                    text: 'Categoria Demandas'
                }
            }
        });
    }

    function createDemandantesCharts(labels, data) {
        demandantesChart.destroy();
        demandantesChart = new Chart(demandantesCtx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Demandantes',
                    data: data,
                    backgroundColor: ['#17a2b8', '#28a745', '#ffc107']
                }],
            },
            options: {
                legend: {
                    position: 'bottom',
                    labels: {
                        fontSize: 14
                    }
                },
                title: {
                    fontSize: 20,
                    display: true,
                    text: 'Categoria Demandantes'
                }
            }
        });
    }
});