$(function () {

    getDemandas()
    getDemandantes()

    function getDemandas() {
        $.ajax({
            url: 'graficos',
            success: function (response) {
                createDemandasCharts(response.demandas);
            }
        });
    }

    function getDemandantes() {
        $.ajax({
            url: 'graficos',
            dataType: 'json',
            success: function (response) {
                createDemandantesCharts(response.demandantes);
            }
        });
    }

    function createDemandasCharts(dataCharts) {
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
    
        function drawChart() {
            var data = google.visualization.arrayToDataTable(Object.entries(dataCharts));
        
            var options = {
                title: 'Categoria Demandas',
                backgroundColor: 'transparent',
                width: '100%',
                height: 400,
                titleTextStyle: {
                    fontSize: 18
                },
                chartArea: {
                    width: '80%', 
                    height: '80%'
                },
                legend: {
                    textStyle: {
                        fontSize: 14
                    }
                },
                tooltip: {
                    textStyle: {
                        fontSize: 13,
                    }
                }
            };
        
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        
            chart.draw(data, options);
        }
    }

    function createDemandantesCharts(dataCharts) {
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
    
        function drawChart() {
            var data = google.visualization.arrayToDataTable(Object.entries(dataCharts));
        
            var options = {
                title: 'Categoria Demandantes',
                backgroundColor: 'transparent',
                width: '100%',
                height: 400,
                titleTextStyle: {
                    fontSize: 18
                },
                chartArea: {
                    width: '80%', 
                    height: '80%'
                },
                legend: {
                    textStyle: {
                        fontSize: 14
                    }
                },
                tooltip: {
                    textStyle: {
                        fontSize: 13,
                    }
                }
            };
        
            var chart = new google.visualization.PieChart(document.getElementById('piechart-demandantes'));
        
            chart.draw(data, options);
        }
    }
});