<html>
	<head>
	<?php
		$senseResponse = file_get_contents('http://smartstreets.sensetecnic.com/cat/sensors');
		$senseResponse = utf8_encode($senseResponse); 
		$senseResJspn = json_encode($senseResponse);
	?>
	
	<link href="css/sunny/jquery-ui-1.10.4.custom.css" rel="stylesheet">
	<link href="css/dataTablesNice.css" rel="stylesheet">	
	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/jquery-ui-1.10.4.custom.js"></script>	
	<script src="js/jquery.dataTables1.9.4.min.js"></script>
	
	<!-- Map Box Links -->
	
	<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
	<script src='https://api.tiles.mapbox.com/mapbox.js/v1.6.1/mapbox.js'></script>
	<script src='http://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/leaflet.markercluster.js'></script>
	
	<link href='https://api.tiles.mapbox.com/mapbox.js/v1.6.1/mapbox.css' rel='stylesheet'/>
	<link href='http://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.css' rel='stylesheet' />
	<link href='http://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.Default.css' rel='stylesheet' />	
		
	<style>
		#map { height: 350px; width:960px; }	
	</style>
		<script type="text/javascript" charset="utf-8">
			var sensors = <?php echo $senseResJspn?>;
			var sensorsParsed = JSON.parse(sensors);
			var sensorRecord = [];
			var aDataSet = [];			
			var smartStreetMarkers = [];
			var smartStreetMarker;	
			
			assembleSensorTableBody();			
			$(document).ready(function() {			
				assembleSensorTable();
				assembleSensorMap();
			});
					
			function assembleSensorTable(){
				$('#dynamic').html( '<table cellpadding="0" cellspacing="0" border="0" class="pretty" id="smartStreet"></table>' );
				$('#smartStreet').dataTable( {
					"aaData": aDataSet,
					"aoColumns": [
						{ "sTitle": "Selected" },
						{ "sTitle": "Maintainer" },
						{ "sTitle": "Description" },
						{ "sTitle": "ID" },
						{ "sTitle": "Name" },
						{ "sTitle": "Tags" }	
					]
				} );
			}	
			
			function assembleSensorTableBody(){
				for (i = 0; i< sensorsParsed.items.length; i++){
					if (sensorsParsed.items[i]["i-object-metadata"].length == 11){
						var smartStreetMarker = [ sensorsParsed.items[i]["i-object-metadata"][10].val,sensorsParsed.items[i]["i-object-metadata"][9].val,
									sensorsParsed.items[i]["i-object-metadata"][4].val, sensorsParsed.items[i]["i-object-metadata"][2].val,
									sensorsParsed.items[i]["i-object-metadata"][7].val, sensorsParsed.items[i].href  ];
								
						smartStreetMarkers.push(smartStreetMarker);

						sensorRecord = [ 	
							"<input type=\"checkbox\" id=\"" + sensorsParsed.items[i]["i-object-metadata"][3].val +"\">", 
							sensorsParsed.items[i]["i-object-metadata"][1].val, sensorsParsed.items[i]["i-object-metadata"][2].val,
							sensorsParsed.items[i]["i-object-metadata"][3].val, sensorsParsed.items[i]["i-object-metadata"][4].val,
							sensorsParsed.items[i]["i-object-metadata"][7].val];
					}
					else{
						if (sensorsParsed.items[i]["i-object-metadata"][2].rel != "urn:X-tsbiot:rels:hasDescription:en"){
							sensorRecord = [
								"<input type=\"checkbox\" id=\"" +sensorsParsed.items[i]["i-object-metadata"][3].val +"\">", 	
								sensorsParsed.items[i]["i-object-metadata"][1].val, " - ",
								sensorsParsed.items[i]["i-object-metadata"][2].val, sensorsParsed.items[i]["i-object-metadata"][3].val,
								sensorsParsed.items[i]["i-object-metadata"][6].val];							
						}
						else{
							sensorRecord = [
								"<input type=\"checkbox\" id=\"" +sensorsParsed.items[i]["i-object-metadata"][3].val +"\">", 		
								sensorsParsed.items[i]["i-object-metadata"][1].val, sensorsParsed.items[i]["i-object-metadata"][2].val,
								sensorsParsed.items[i]["i-object-metadata"][3].val, sensorsParsed.items[i]["i-object-metadata"][4].val,
								"-"];		
						}
					}
					aDataSet.push(sensorRecord);
				}				
			}
			
			function assembleSensorMap(){			
				var map = L.mapbox.map('map')
					    .setView([54.4, -50.5], 3)
						.addLayer(L.mapbox.tileLayer('chrisfjoyce.h9p8b2mj'));
				    
				map.addControl(L.mapbox.infoControl());
				map.infoControl.addInfo("Beta at Best");
				
				var markers = new L.MarkerClusterGroup();
				for (var i = 0; i < smartStreetMarkers.length; i++) {
					var a = smartStreetMarkers[i];
					//c(a);
					var title = "<b><font color=\"#3ca0d3\">" + a[2] +"</b></font><br>" + a[3] +"<br>&nbsp;<br><font color=\"#3ca0d3\"><i>Tags</i></font><br>" + a[4]
								+"<br>&nbsp; <br><font color=\"#3ca0d3\"><i>Data</i></font><br>" + "<a href=\"" +a[5] +"\"><font color = \"#000\"><u>Click to open link.</u></a>";
					var marker = L.marker(new L.LatLng(a[1], a[0]), {
					icon: L.mapbox.marker.icon({'marker-symbol': 'star', 'marker-color': '#f86767'}),
					title: title
				});
				marker.bindPopup(title);
				markers.addLayer(marker);
				}

				map.addLayer(markers);
			}
				/*
				L.mapbox.featureLayer('chrisfjoyce.h9p8b2mj').on('ready', function(e) {
				    var clusterGroup = new L.MarkerClusterGroup();
				    e.target.eachLayer(function(layer) {
				        clusterGroup.addLayer(layer);
				    });
				    map.addLayer(clusterGroup);
				});			
				*/	
		</script>
	</head>
	<body>
	<br>
		<div id ="container">
			<h3><b> SmartStreets Sensors from Catalog</b></h3><i> (http://smartstreets.sensetecnic.com/cat/sensors)</i>
			<div id="map"></div>
					<div id="dynamic"></div>				
					
			</div>
			

	</body>
</html>