$(function(){

	google.charts.load('current', {packages: ['corechart', 'bar']});
	google.charts.setOnLoadCallback(drawBasic);

	function drawBasic() {

	    var api = new mw.Api();
        api.get({
            action: 'cipfastgraphs',
            do: 'first'
        }).done(function(result){

			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Year');
			data.addColumn('number', 'ICIs');
			data.addColumn({type: 'string', role: 'tooltip'});

			data.addRows(result.cipfastgraphs.result);

			var options = {
				title: '',
				hAxis: {
					title: 'Year',
                    format: '#'
				},
				vAxis: {
					title: ''
				},
                legend: {
				    position: 'none'
                },
				chartArea: {'width': '100%', 'height': '80%'}
			};

			var chart = new google.visualization.ColumnChart(
				document.getElementById('cipgraph1'));

			chart.draw(data, options);

        });
	}

});
