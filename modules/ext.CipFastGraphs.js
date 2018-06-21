$(function(){

	google.charts.load('current', {packages: ['corechart', 'bar']});
	google.charts.setOnLoadCallback(startCharts);

	function startCharts() {
	    drawBasic();
	    drawBasic2();
    }

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
				bar: {groupWidth: "90%"},
				hAxis: {
					title: 'Year',
                    format: '#',
					/*direction:-1,
					slantedText: true,
					slantedTextAngle: 90,*/
					textStyle : {
						fontSize: 10 // or the number you want
					}
				},
				vAxis: {
					title: 'ICIs'
				},
                legend: {
				    position: 'none'
                },
				chartArea: {'width': '90%', 'height': '80%'}
			};

			var chart = new google.visualization.ColumnChart(
				document.getElementById('cipgraph1'));

			chart.draw(data, options);

        });
	}

	function drawBasic2() {

		var api = new mw.Api();
		api.get({
			action: 'cipfastgraphs',
			do: 'second'
		}).done(function(result){

			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Members');
			data.addColumn('number', 'ICIs');
			data.addColumn({type: 'string', role: 'tooltip'});

			data.addRows(result.cipfastgraphs.result);

			var options = {
				title: '',
				hAxis: {
					title: 'Members',
					format: '#'
				},
				vAxis: {
					title: 'ICIs'
				},
				legend: {
					position: 'none'
				},
				chartArea: {'width': '85%', 'height': '80%'}
			};

			var chart = new google.visualization.ColumnChart(
				document.getElementById('cipgraph2'));

			chart.draw(data, options);

		});
	}

});
