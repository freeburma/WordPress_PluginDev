<h1>Welcome to my plugin</h1>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div id="chart_div"></div>

<script>
google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(drawBackgroundColor);

function drawBackgroundColor() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'X');
      data.addColumn('number', 'Monthly Sale');

      data.addRows([
        ['Jan', 3000], ['Feb', 3134],  
        ['Mar', 4199], ['Apl', 1999], 
        ['May', 700], ['Jun', 300], 
        ['Jul', 450], ['Aug', 1024], 
        ['Sep', 2456], ['Oct', 4579], 
        ['Nov', 5104], ['Dec', 5456], 
      ]);


      var options = {
        
        vAxis: {
          title: 'Sale'
        },
        hAxis: {
          title: 'Month'
        },
        backgroundColor: '#f1f8e9'
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
</script>
      