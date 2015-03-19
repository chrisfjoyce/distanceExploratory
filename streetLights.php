

<html>
<head> 
	<?php
		$response = file_get_contents('http://strauss.ccr.bris.ac.uk/catalogue/services/api/smartstreetlights/data');
		$response = utf8_encode($response); 
		$respJson = json_encode($response);	
		
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

<script>

var sensors = <?php echo $respJson?>;
var sensorsParsed 	= JSON.parse(sensors);
var streetLightMarkers	= [];
var streetLights 		= [];
var streetLight 		= [];

//console.log(sensorsParsed.items[1]);

createTableBody();
$(document).ready(function() {			
	assembleSensorTable();
	assembleSensorMap();
});
					
function assembleSensorTable(){
	$('#dynamic').html( '<table cellpadding="0" cellspacing="0" border="0" class="pretty" id="smartLights"></table>' );
	$('#smartLights').dataTable( {
		"aaData": streetLights,
		"aoColumns": [
			{ "sTitle": "CMS Unit Ref" 		},
			{ "sTitle": "Ctrl Equip Type" 	},
			{ "sTitle": "District" 			},
			{ "sTitle": "Lamp Type" 		},
			{ "sTitle": "No Ctrl" 			},
			{ "sTitle": "Nominal Power" 	},	
			{ "sTitle": "Preset Dim Lvl" 	},
			{ "sTitle": "Road" 				},
			{ "sTitle": "Stand by Power" 	},
			{ "sTitle": "Switch Regime" 	},
			{ "sTitle": "Unit ID" 			}									
		]
	} );
}

function createTableBody(){
	for (i = 0; i< sensorsParsed.items.length; i++){
		var ref 		= (sensorsParsed.items[i].hasOwnProperty('CMSUnitReference')) 		? sensorsParsed.items[i].CMSUnitReference 		: "-";
		var ctrlType 	= (sensorsParsed.items[i].hasOwnProperty('ControlEquipmentType')) 	? sensorsParsed.items[i].ControlEquipmentType 	: "-";	
		var district 	= (sensorsParsed.items[i].hasOwnProperty('District')) 				? sensorsParsed.items[i].District 				: "-";
		var lampType 	= (sensorsParsed.items[i].hasOwnProperty('LampType')) 				? sensorsParsed.items[i].LampType 				: "-";
		var lat 		= (sensorsParsed.items[i].hasOwnProperty('Latitude')) 				? sensorsParsed.items[i].Latitude 				: "-";			
		var lng 		= (sensorsParsed.items[i].hasOwnProperty('Longitude')) 				? sensorsParsed.items[i].Longitude 				: "-";			
		var noCtrl 		= (sensorsParsed.items[i].hasOwnProperty('NoControl')) 				? sensorsParsed.items[i].NoControl 				: "-";			
		var noItem 		= (sensorsParsed.items[i].hasOwnProperty('NoItem')) 				? sensorsParsed.items[i].NoItem 				: "-";			
		var nomPower 	= (sensorsParsed.items[i].hasOwnProperty('NominalPower')) 			? sensorsParsed.items[i].NominalPower 			: "-";			
		var presetLvl 	= (sensorsParsed.items[i].hasOwnProperty('PresetDimLevel')) 		? sensorsParsed.items[i].PresetDimLevel 		: "-";			
		var road	 	= (sensorsParsed.items[i].hasOwnProperty('Road')) 					? sensorsParsed.items[i].Road 					: "-";			
		var stdPower 	= (sensorsParsed.items[i].hasOwnProperty('StandbyPower')) 			? sensorsParsed.items[i].StandbyPower 			: "-";			
		var switchRgm 	= (sensorsParsed.items[i].hasOwnProperty('SwitchRegime')) 			? sensorsParsed.items[i].SwitchRegime 			: "-";			
		var unitID 		= (sensorsParsed.items[i].hasOwnProperty('UnitId')) 				? sensorsParsed.items[i].UnitId 				: "-";			
		streetLight = [ ref, ctrlType, district, lampType, noCtrl, nomPower, presetLvl, road, stdPower, switchRgm, unitID	   ];
		streetLights.push(streetLight);
					
		if (lat == "-" || lng == "-"){
			// Rogue Value - Lets have a look at it.
			console.log(smartLight);
		}
		else {			
				var mrkr = [ lat, lng, ref, ctrlType, district, lampType, noCtrl, nomPower, presetLvl, road, stdPower, switchRgm, unitID	   ]; 
				streetLightMarkers.push(mrkr);			
		}
	}
}


function assembleSensorMap(){			
	var map = L.mapbox.map('map')
		    .setView([52, 0], 7)
			.addLayer(L.mapbox.tileLayer('chrisfjoyce.h9p8b2mj'));
	    
	map.addControl(L.mapbox.infoControl());
	map.infoControl.addInfo("Beta at Best");
	
	var markers = new L.MarkerClusterGroup();
	for (var i = 0; i < streetLightMarkers.length; i++) {
		var a = streetLightMarkers[i];
		
		var name = "<b><font color=\"#3ca0d3\">"  + a[9] + ", " + a[4] +"</b></font>";
		var tags = "<br><font color=\"#3ca0d3\"><i>Tags</i></font><br>None";
		var data = "<br><font color=\"#3ca0d3\"><i>Data</i></font>"
						+"<br>Nominal Power: " + a[7]
						+"<br>Preset Dim Level: " + a[8]
						+"<br>Standby Power: " +a[10];
		
		var title = name + tags + data;
						
						
					
		var marker = L.marker(new L.LatLng(a[0], a[1]), {
			icon: L.mapbox.marker.icon({'marker-symbol': 'star', 'marker-color': '#f86767'}),
			title: title });
			
		marker.bindPopup(title);
		markers.addLayer(marker);
	}
	map.addLayer(markers);
}

	

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