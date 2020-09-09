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
                    backgroundColor: ['#791000','#ef7771','#00A593', '#157DB2', '#41AEF2'],
                }],
            },
            options: {
                legend: {
                    position: 'bottom',
                    labels: {
                        fontSize: 13
                    }
                },
                title: {
                    fontSize: 18,
                    display: true,
                    text: 'Categoria Demandas'
                },
                plugins: {
                    datalabels: {
                        formatter: (value, ctx) => {
                           let sum = 0;
                           let dataArr = ctx.chart.data.datasets[0].data;
                           dataArr.map(data => {
                               sum += data;
                           });
                           let percentage = (value*100 / sum).toFixed(2)+"%";
                           return percentage;
                        },
                        color: '#000',
                        font: {
                            weight: '600',
                            size: 12
                        }
                    },
     
                },
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
                        fontSize: 13
                    }
                },
                title: {
                    fontSize: 18,
                    display: true,
                    text: 'Categoria Demandantes'
                },
                plugins: {
                    datalabels: {
                        formatter: (value, ctx) => {
                           let sum = 0;
                           let dataArr = ctx.chart.data.datasets[0].data;
                           dataArr.map(data => {
                               sum += data;
                           });
                           let percentage = (value*100 / sum).toFixed(2)+"%";
                           return percentage;
                        },
                        color: '#000',
                        font: {
                            weight: '600',
                            size: 12
                        }
                    },
                },
            }
        });
    }
});