<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="http://www.gstatic.com/charts/loader.js"></script>
    <script>
      function init() {
        google.load("visualization", "44", {packages:["corechart"]});
        var interval = setInterval(function () {
          if (google.visualization !== undefined && google.visualization.DataTable !== undefined
            && google.visualization.PieChart !== undefined) {
            clearInterval(interval);
            window.status = 'ready';
            drawChart();
            drawChart2();
          }
        }, 100);
      }

      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Element');
        data.addColumn('number', 'Percentage');
        data.addRows([
          ['Nitrogen', 0.78],
          ['Oxygen', 0.21],
          ['Other', 0.01]
        ]);

        var chart = new google.visualization.PieChart(document.getElementById('myPieChart'));
        chart.draw(data, {});
      }

      function drawChart2() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Element');
        data.addColumn('number', 'Percentage');
        data.addRows([
          ['Nitrogen', 0.78],
          ['Oxygen', 0.21],
          ['Other', 0.01]
        ]);

        var chart2 = new google.visualization.PieChart(document.getElementById('myPieChart2'));
        chart2.draw(data, {});
      }
    </script>
</head>

    <body onload="init()">
        <div class="d-flex">
            <div>
                <div id="myPieChart" style="width: 520px; height: 300px;"></div>
            </div>
            <div>
                <div id="myPieChart2" style="width: 520px; height: 300px;"></div>
            </div>
        </div>


    </body>
</html>
