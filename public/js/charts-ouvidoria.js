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
                titleTextStyle: {
                    fontSize: 17
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
                titleTextStyle: {
                    fontSize: 17
                }
            };
        
            var chart = new google.visualization.PieChart(document.getElementById('piechart-demandantes'));
        
            chart.draw(data, options);
        }
    }
});