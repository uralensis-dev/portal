$(document).ready(function() {

	// Bar Chart
	if (typeof SITE_URL !== 'undefined') {
		$.ajax({
			url: SITE_URL+"chart-rcds",
			method: "GET",
			dataType: "json", //parse the response data as JSON automatically
			success: function(data) {
				$('#bar-charts').html('');
				if (document.getElementById('bar-charts') != null) {
					Morris.Bar({
						element: 'bar-charts',
						data: data,
						xkey: 'y',
						ykeys: ['a', 'b'],
						labels: ['Total Records', 'New Records'],
						lineColors: ['#00c5fb','#0253cc'],
						lineWidth: '3px',
						barColors: ['#00c5fb','#0253cc'],
						resize: true,
						redraw: true
					});
				}
			}
		  });
	
	
	
		
		
		// Line Chart
		$.ajax({
			url: SITE_URL+"chart-rcds",
			method: "GET",
			dataType: "json", //parse the response data as JSON automatically
			success: function(data) {
				$('#line-charts').html('');
				if (document.getElementById('line-charts') != null) {
					Morris.Line({
						element: 'line-charts',
						data: [
							{ y: '2019-11', a: 100, b: 50 },
							{ y: '2019-12', a: 75,  b: 65 },
							{ y: '2020-01', a: 50,  b: 40 },
							{ y: '2020-02', a: 75,  b: 65 },
							{ y: '2020-03', a: 40,  b: 55 },
							{ y: '2020-04', a: 75,  b: 65 },
							{ y: '2020-05', a: 90, b: 80 }
						],
						xkey: 'y',
						ykeys: ['a', 'b'],
						xLabels: "month",
						labels: ['Total Costs', 'Unpaid Invoices'],
						lineColors: ['#00c5fb','#0253cc'],
						lineWidth: '3px',
						resize: true,
						redraw: true
					});
				}
			}
		  });

	}

	
		
});