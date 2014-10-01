<!DOCTYPE HTML>
<html>
	<head>
	<?php
	function printData(){
		$user = 'root';  
		$pswd = 'calplug2012';  
		$db = 'smart_meter_reading';  
		$conn = mysql_connect('localhost', $user, $pswd);  
		mysql_select_db($db, $conn);
		$query = "select Consumption from smart_meter_reading.Apr2013 where Timestamp like \"%58%\" order by Timestamp ASC";
		$result = mysql_query($query);
		$temp = 0;
		$counter = 0;
		while($row = mysql_fetch_array($result))
		{
			if ($counter==0){
				echo 0.289;//hardcoded estimation for the initial value
				echo ",";
				$temp = intval($row[0]) / 1000;
				$counter++;
			}
			else {
				$value = intval($row[0]) / 1000 - $temp;
				echo round($value,4);
				echo ",";
				$temp = intval($row[0]) / 1000;
			}
		};
		
		
		//echo "7,8,8,1,2,3,4,5,5,5,6,6,6,6,6,7,8,8,1,2,3,4,5,5,5,6,6,6,6,6,7,8,8,1,2,3,4,5,5,5,6,6,6,6,67,8,8,1,2,3,4,5,5,5,6,6,6,6,67,8,8,1,2,3,4,5,5,5,6,6,6,6,67,8,8,1,2,3,4,5,5,5,6,6,6,6,6";
	}
	?>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Household Energy Consumption Display</title>

		<script src="js/jquery-1.8.2.js"></script>
		<script src="js/highcharts.js"></script>
		<script src="js/modules/exporting.js"></script>
		<script type="text/javascript">
		var date = new Date();
		var now = Date.now();
		//alert(Date.UTC(2013, 3, 03));
$(function () {
		var consumption = [<?php printData() ?>];
		for(var i = consumption.length-1; i--;) {
			if (consumption[i] > 1000) {
				$('#debug').html(consumption[i].toString());
				consumption.splice(i,1);
			}
		}
        $('#container').highcharts({
            chart: {
                zoomType: 'x',
                spacingRight: 0
            },
			credits: {
				enabled: false
			},
            title: {
                text: 'Household Energy Consumption Display'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                    'Click and drag in the plot area to zoom in' :
                    'Drag your finger over the plot to zoom in'
            },
            xAxis: {
                type: 'datetime',
                maxZoom: 12 * 3600000, // 12 hours
                title: {
                    text: null,
                }
            },
            yAxis: {
                title: {
                    text: 'Power Consumption in kWH'
                }
            },
            tooltip: {
                shared: true
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1},
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    lineWidth: 1,
                    marker: {
                        enabled: false
                    },
                    shadow: false,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },
    
            series: [{
                type: 'column',  //area, areaspline, bar, column, line, pie, scatter or spline, arearange, areasplinerange and columnrange
                name: 'Power Consumed in Past Hour',
                pointInterval: 3600 * 1000, //1 hour
				pointStart: now - 145 * 3600000,//now - 2 * 24 * 3600000 - 8 * 3600000,//Date.UTC(2013, 3, 03) 
//                pointStart: Date.UTC(2013, 3, 3) + 16 * 3600000,//now - 2 * 24 * 3600000 - 8 * 3600000,//Date.UTC(2013, 3, 03) 
                data: consumption
            }]
        });
    });
    

		</script>
	</head>
	<body>


<div id="container" style="width: 1500px; height: 500px; margin: 0 auto"></div>

	</body>
</html>
