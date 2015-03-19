<html>
<head>

<?php
	$feedno 	= $_GET["feedId"];
	$extfeedno 	= $_GET["extFeedId"];
	$startT		= $_GET["start"];
	$endT		= $_GET["end"];
	$dataJSON	= "empty";
	
	if($extfeedno ==""){ 
		$a = $a+1;
	}
	else{
		$dataList = explode(',',$extfeedno);
		$devURL = array ("http://imove-project.org/api/","/datastreams/0/datapoints?");
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERPWD, "88ff22fac837f844e88917dd103956b9:");
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	
		$data = array();
		$arrlength=count($dataList);
		for ($x=0; $x<$arrlength; $x++){
			curl_setopt($ch, CURLOPT_URL, $devURL[0].$dataList[$x].$devURL[1]);	
			$output = curl_exec($ch);
			$info = curl_getinfo($ch);
			array_push($data, $output);
		} 
		curl_close($ch);
		$dataString = implode(" ",$data);
		$dataString = utf8_encode($dataString); 
		$dataJSON = json_encode($dataString);
	}
		
	$response = file_get_contents('http://chrisfjoyce.com/superCat.txt');
	$response = utf8_encode($response); 
	$respJson = json_encode($response);			
				 
?>

<!-- Includes -->
	<!-- JQuery -->
	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/jquery-ui-1.10.4.custom.js"></script>
	
	<!-- Moment.js Time based library -->
	<script src="js/moment.min.js"></script>
	
	<!-- Statistics Package Used on a per feed level -->
	<script src="js/jStats.js"></script>
	
	<!-- Rickshaw and D3 graphs -->
	<script src="js/d3.min.js"></script>
	<script src="js/d3.layout.min.js"></script>
	<script src="js/Rickshaw.js"></script>
	<script src="js/Rickshaw.Class.js"></script>
	<script src="js/Rickshaw.Compat.ClassList.js"></script>
	<script src="js/Rickshaw.Graph.js"></script>
	<script src="js/Rickshaw.Graph.Renderer.js"></script>
	<script src="js/Rickshaw.Graph.Renderer.Area.js"></script>
	<script src="js/Rickshaw.Graph.Renderer.Line.js"></script>
	<script src="js/Rickshaw.Graph.Renderer.Bar.js"></script>
	<script src="js/Rickshaw.Graph.Renderer.ScatterPlot.js"></script>
	<script src="js/Rickshaw.Graph.Renderer.Stack.js"></script>
	<script src="js/Rickshaw.Graph.RangeSlider.js"></script>
	<script src="js/Rickshaw.Graph.RangeSliderY.js"></script>		
	<script src="js/Rickshaw.Graph.RangeSlider.Preview.js"></script>
	<script src="js/Rickshaw.Graph.HoverDetail.js"></script>
	<script src="js/Rickshaw.Graph.Annotate.js"></script>
	<script src="js/Rickshaw.Graph.Legend.js"></script>
	<script src="js/Rickshaw.Graph.Axis.Time.js"></script>
	<script src="js/Rickshaw.Graph.Behavior.Series.Toggle.js"></script>
	<script src="js/Rickshaw.Graph.Behavior.Series.Order.js"></script>
	<script src="js/Rickshaw.Graph.Behavior.Series.Highlight.js"></script>
	<script src="js/Rickshaw.Graph.Smoother.js"></script>
	<script src="js/Rickshaw.Fixtures.Time.js"></script>
	<script src="js/Rickshaw.Fixtures.Time.Local.js"></script>
	<script src="js/Rickshaw.Fixtures.Number.js"></script>
	<script src="js/Rickshaw.Fixtures.RandomData.js"></script>
	<script src="js/Rickshaw.Fixtures.Color.js"></script>
	<script src="js/Rickshaw.Color.Palette.js"></script>
	<script src="js/Rickshaw.Graph.Axis.Y.js"></script>
	
	
	<!--Mapbox -->
	<script src='https://api.tiles.mapbox.com/mapbox.js/v1.6.1/mapbox.js'></script>
	<script src='http://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/leaflet.markercluster.js'></script>
	<script src="http://d23cj0cdvyoxg0.cloudfront.net/xivelyjs-1.0.3.min.js"></script>  	
	
	<!-- Data Table -->		
	<script src="js/jquery.dataTables1.9.4.min.js"></script>


<!- CSS -->
	<link href="css/sunny/jquery-ui-1.10.4.custom.css" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="css/graph.css">
	<link type="text/css" rel="stylesheet" href="css/detail.css">
	<link type="text/css" rel="stylesheet" href="css/legend.css">
	<link href='https://api.tiles.mapbox.com/mapbox.js/v1.6.1/mapbox.css' rel='stylesheet' />
	<link href='http://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.css' rel='stylesheet' />
	<link href='http://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.Default.css' rel='stylesheet' />	
	<link href="css/dataTablesNice.css" rel="stylesheet">	

<!-- Meta Fun -->
	<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
	<link rel="shortcut icon" href="http://www.iotschools.org.uk/favicon.ico"/>


<!-- Additional Page Styles -->
<style>
h2 {line-height: 1.4; padding: 0.5em }
.map { height: 270px; width:445px; }
.rickshaw_graph .detail .item { line-height: 1.4; padding: 0.5em }
.rickshaw_graph .detail .x_label { display: none }
.detail_swatch { float: left; display: inline-block; width: 10px; height: 10px; margin: 0 4px 0 0 }

table.statsTable { border-collapse:collapse; }
table.statsTable td, table.statsTable th { border:1px solid #7E6B58 ;padding:5px; border-radius: 5px; }

th{ background-color:LightGray;}


div.graphControls {
	float: right;
	margin-left: 20px;
}
body{
	background-color: ghostwhite;
}	
.chart_title{
	height: 50px;
	background-color: black;
}
.chart_container {
	position: relative;
	display: inline-block;
	font-family: Arial, Helvetica, sans-serif;
}
.y_axis{
	float: left;
	width: 40px;
	height: 400px;	
}		
.chart {
	float: left;
}	
.legend {
	float: left;
	margin-left: 15px;
}	
.graphYSlider {
	float: left;
	height: 400px;
	margin-left: 20px;
}	
.graphXSlider{
	clear: both;
	position: relative;
	left: 40px;
	width: 550px;
}	
.offset_form {
	float: left;
	margin: 2em 0 0 15px;
	font-size: 13px;
}

</style>

<script>
// Global Variables
var unsortedData		= [];
var sortedData			= [];	//Super Data Structure
var removedData			= [];
var feedPointer 		= 0;	//Needed to for the recursive get
var mapSource			= ["examples.map-9ijuk24y","chrisfjoyce.h9p8b2mj"];
var mapSourcePointer	= 1;	// When testing use 0, when released use 1
var colorList 			= getColors();
var startEnd 			= getStartEnd();
//var query				= { start: startEnd.start, end: startEnd.end, interval: 60, limit: 1000 };
var query				= { start: startEnd.start, end: startEnd.end, limit: 1000 };
var loadingDetails 		= "";
var progressDetails 	= "";
var externalDev 		= "<?php echo $extfeedno?>";
var extDevList 			= externalDev.split(",");
var externalData 		= [];

$(document).ready(function() {
	xively.setKey( 	"8cyHFd7vHCYeJ4x0mOEcgFmkOPUheWtK4Nu1YTOyKhxwFsLC" );
	progressMsg( 	"<b>Getting Data Feeds for the Devices selected.</b><br>");
	$( "#progressbar" ).progressbar({value: 0, max: 100});	
	var streamInfo		= getStreamInfo();	//Go to the catalog and poplulate feedInfo[] for each of the selected devices
	unsortedData		= getAllDataStreams(streamInfo);	
	getData();			//Code goes Asynch after this point -> but returns to mainFlow() once data retrieved
});


function mainFlow(){
	$("#loading").hide();
	removeEmptyStreams();
	parseData();
	calculateStats();
	sortedData = sortDataStreams(unsortedData);
	graphSetup();		
	drawGraphs();
	
	console.log("Sorted Data:");
	console.log(sortedData);

	//Set up each graph
	//Draw Graphs	
}

function graphSetup(){
	setLimits();
	progressMsg( "clear" );		
}

function setLimits(){
	for (var a = 0; a< sortedData.length; a++ ){
		var minList = [];
		var maxList = [];
		for ( var b = 0; b< sortedData[a].content.length; b++ ){
			minList.push(sortedData[a].content[b].min);
			maxList.push(sortedData[a].content[b].max);			
		}
		
		var dsMin = jsStats.min(minList);
		var dsMax = jsStats.max(maxList);	
		dsMax *= 1.2;	
		dsMin = Math.floor(dsMin/10)*10;		
		sortedData[a].min = dsMin;
		sortedData[a].max = dsMax;		
	}
}


function drawGraphs(){	
	for (var q=0; q< sortedData.length; q++){
		drawGraph(q);
	}
	initialseJQueryObjects();
}

function drawGraph(graphNo){
	var uiChartTitle 			= document.createElement('div');
	var uiTopSpace	 			= document.createElement('div');	
	var uiBotSpace				= document.createElement('div');
		
	var uiChartContainer 		= document.createElement('div');
	var uiYAxis			 		= document.createElement('div');
	var uiChart	 				= document.createElement('div');
	var uiYSlider		 		= document.createElement('div');
	var uiGraphCtrls 			= document.createElement('div');
	var uiMap			 		= document.createElement('div');
	var uiDisplayCtrls	 		= document.createElement('div');
	
	var uiLegend		 		= document.createElement('div');
	var uiXSlider				= document.createElement('div');
	var uiStats					= document.createElement('div');
	var uiCSV			 		= document.createElement('div');	
	
	uiYSlider.id				= "sliderY" +graphNo;
	uiMap.id 					= "map" 	+graphNo;
	uiLegend.id					= "legend" 	+graphNo;
	uiStats.id					= "stats" 	+graphNo;
	uiCSV.id					= "download"+graphNo;
	uiDisplayCtrls.id			= "dspCtrls"+graphNo;
	
	//ADD CSS Class Tags
	uiChartTitle.className 		= "chart_title";
	uiChartContainer.className 	= "chart_container";	
	uiYAxis.className 			= "y_axis";			 	
	uiChart.className 			= "chart";	 			
	uiYSlider.className 		= "graphYSlider";		 	
	uiGraphCtrls.className		= "graphControls";	
	uiMap.className 			= "map";		 	
	uiLegend.className 			= "legend"; 		 	
	uiXSlider.className 		= "graphXSlider";

	uiChartTitle.innerHTML		= 	"<h2><font color=\"white\">" 
									+sortedData[graphNo].label + " ("
									+sortedData[graphNo].symbol + ")" +"</font></h2>";
	
	uiDisplayCtrls.innerHTML	= "<form id=\"offset"+graphNo +"\" class=\"toggler offset_form\">"
									+"<input type=\"radio\" name=\"offset\" id=\"lines"+graphNo+"\"value=\"lines\">"
									+"<input type=\"radio\" name=\"offset\" id=\"scatter"+graphNo+"\"value=\"scatter\" checked> "
									+"<label class=\"lines\" for=\"lines"+graphNo+"\">Line</label>"
									+"<label class=\"scatter\" for=\"scatter"+graphNo+"\">Scatter</label>"
								+"</form>&nbsp<br>&nbsp<br>&nbsp<br>";

								
	uiGraphCtrls.innerHTML		= "<ul>" 
									+"<li><a href=\"#" +uiMap.id +"\">Map</a></li>" 
									+"<li><a href=\"#" +uiLegend.id +"\">Legend</a></li>" 
									+"<li><a href=\"#" +uiDisplayCtrls.id +"\">Display</a></li>" 																	
									+"<li><a href=\"#" +uiStats.id +"\">Stats</a></li>" 																	
									+"<li><a href=\"#" +uiCSV.id +"\">Download</a></li>" 									
								+"</ul>";
	
	

	var simpleStats = '<table class="statsTable">'
						+'<thead><tr><th>Mean</th><th>Median</th><th>Mode</th><th>Minimum</th><th>Maximum</th><th>Variance</th></tr></thead><tbody>';
	
	for (var s= 0; s< sortedData[graphNo].content.length; s++){

 		simpleStats		+=	"<tr style=\"color:" +sortedData[graphNo].content[s].col +"\"><td>"
 							+sortedData[graphNo].content[s].stats.mean.toFixed(2)+"</td>"
							+"<td>" +sortedData[graphNo].content[s].stats.median.toFixed(2)+"</td>"
							+"<td>"+sortedData[graphNo].content[s].stats.mode[0].toFixed(2)+"</td>"
							+"<td>"+sortedData[graphNo].content[s].stats.min.toFixed(2)+"</td>"
							+"<td>"+sortedData[graphNo].content[s].stats.max.toFixed(2) +"</td>"
							+"<td>"+sortedData[graphNo].content[s].stats.variance.toFixed(2) + "</td></tr>"
							+"</font>";
	}
	simpleStats += "</tbody></table>";
	uiStats.innerHTML = simpleStats;
	
	
	//$('#'+divID).html( "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"pretty\" id=\""+tableID +"\" ></table>" );
	
	uiCSV.innerHTML	= assembleDownloadDiv(graphNo);
	
	// Build the div structure for the graph.	
	uiGraphCtrls.appendChild(uiMap);
	uiGraphCtrls.appendChild(uiLegend);										
	uiGraphCtrls.appendChild(uiDisplayCtrls);	
	uiGraphCtrls.appendChild(uiStats);
	uiGraphCtrls.appendChild(uiCSV);
	
	uiChartContainer.appendChild(uiYAxis);
	uiChartContainer.appendChild(uiChart);
	uiChartContainer.appendChild(uiYSlider);
	uiChartContainer.appendChild(uiGraphCtrls);
	
	uiTopSpace.setAttribute("style","height:20px");
	uiBotSpace.setAttribute("style","height:20px");
	
	document.getElementsByTagName('body')[0].appendChild(uiChartTitle);
	document.getElementsByTagName('body')[0].appendChild(uiTopSpace);	
	document.getElementsByTagName('body')[0].appendChild(uiChartContainer);
	document.getElementsByTagName('body')[0].appendChild(uiXSlider);
	document.getElementsByTagName('body')[0].appendChild(uiBotSpace);	

	//Initialize YSlider - if this is done in generic code there will be an offset on the top handle.
	$( "#"+uiYSlider.id ).slider({
	  orientation: "vertical",
	  range: true
	});
	
	graphSeries = [];
	
	var map = L.mapbox.map(uiMap)
			.addLayer(L.mapbox.tileLayer(mapSource[mapSourcePointer]));
	
	

	//map.infoControl.addInfo("Beta at Best");	
	var markers = new L.MarkerClusterGroup();	
	
	for ( var q = 0; q < sortedData[graphNo].content.length; q++){
		var graphCol	= sortedData[graphNo].content[q].col;
		var graphData 	= sortedData[graphNo].content[q].cleanData;
		var graphFeedNm = sortedData[graphNo].content[q].location.name +" " 
							+sortedData[graphNo].content[q].channel +" ("  +sortedData[graphNo].symbol +")";
		graphSeries[q]	= { color: graphCol, data: graphData, name: graphFeedNm }
		var lat 		= sortedData[graphNo].content[q].location.lat;
		var lon 		= sortedData[graphNo].content[q].location.lon;		
		
		var marker = L.marker(new L.LatLng(lat, lon), {
			icon: L.mapbox.marker.icon({'marker-symbol': 'star', 'marker-color': graphCol}),
			title: graphFeedNm });
			
		marker.bindPopup(graphFeedNm);
		markers.addLayer(marker);
		
	}
	map.addLayer(markers);
	map.fitBounds(markers.getBounds());
	
	var graph = new Rickshaw.Graph( {
		element: uiChart,
		width: 550,
		height: 400,
		interpolation: 'linear',
		renderer: 'scatterplot',
		max: 	sortedData[graphNo].max,
		min: 	sortedData[graphNo].min,
		series: graphSeries
	} );
	
	graph.renderer.dotSize = 2;		
	
	var x_axis = new Rickshaw.Graph.Axis.Time( { graph: graph } );
	
	var y_axis = new Rickshaw.Graph.Axis.Y( {
	    graph: graph,
	    orientation: 'left',
	    tickFormat: Rickshaw.Fixtures.Number.formatKMBT,
	    element: uiYAxis,
	});
	
	var legend = new Rickshaw.Graph.Legend( {
        element: uiLegend,
        graph: graph
	});
	
	var slider = new Rickshaw.Graph.RangeSlider({
		 graph: graph,
		 element:uiXSlider
	});
	
	var sliderY = new Rickshaw.Graph.RangeSliderY({
		 graph: graph,
		 element:uiYSlider
	});

	var order = new Rickshaw.Graph.Behavior.Series.Order({
	    graph: graph,
	    legend: legend
	});	
	
	var shelving = new Rickshaw.Graph.Behavior.Series.Toggle( {
	    graph: graph,
	    legend: legend
	});  
		  
	var highlighter = new Rickshaw.Graph.Behavior.Series.Highlight( {
		graph: graph,
		legend: legend
	});
	
	var hoverDetail = new Rickshaw.Graph.HoverDetail( {
		graph: graph,
		formatter: function(series, x, y) {
			var date = '<span class="date">' + new Date(x * 1000).toUTCString() + '</span>';
			var swatch = '<span class="detail_swatch" style="background-color: ' + series.color + '"></span>';
			var content = swatch + series.name + ": " + y + '&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<br>' + date;
			return content;
		}
	} );

	var offsetForm = document.getElementById("offset"+graphNo);
	offsetForm.addEventListener('change', function(e) {
		var offsetMode = e.target.value;
		console.log("drawGraph() Offset Mode:" +offsetMode);
		
		if (offsetMode == 'lines') {
		    graph.setRenderer('line');
		    graph.offset = 'zero';
		}
		else if (offsetMode == 'scatter')
		{
		    graph.setRenderer('scatterplot');;
		    graph.offset = 'zero';
		    graph.renderer.dotSize = 2;                
		}
		else
		{
			console.log("drawGraph() not implemented yet.");
		}

		
		graph.render();
		
	}, false);
	
	graph.render();			
	
	
}

function downloadCSV(clickedID){
	var csvDataSource = clickedID.split("_");
	var graphNum = csvDataSource[0];
	var seriesNum = csvDataSource[1]; 
	window.open(sortedData[graphNum].content[seriesNum].csv.uri);
}


function assembleDownloadDiv(dataStreamNumber){
	var csvString = "<table>";	
	
	for ( var r = 0; r < sortedData[dataStreamNumber].content.length; r++){
		csvString += "<tr style=\"color:" +sortedData[dataStreamNumber].content[r].col +"\"><td>"
					+sortedData[dataStreamNumber].content[r].location.name
					+"</td><td><button onclick=\"downloadCSV(this.id)"
					+ "\" class=\"csvButton\""
					+ " id=\"" 
					+ dataStreamNumber + "_" +r
					+"\" title=\"Download Data & Open in Excel or some other Spreadsheet Software.\">CSV</button></td></tr>";
	}
	
	csvString +="</table>";
	return csvString;	
}



function parseData(){	
	for ( var j = 0; j < unsortedData.length; j++){
		var csvContent = "data:text/csv;charset=utf-8,";	//Set up header for CSV					
		csvContent += unsortedData[j].feedId +" " +unsortedData[j].id + "\n";
		csvContent += "date time," + unsortedData[j].label +"(" + unsortedData[j].symbol +")\n"; 		
		var parsedData = [];
							
		for ( var k=0; k < unsortedData[j].rawData.length; k++ ) {
	  		var dateRough = moment(unsortedData[j].rawData[k].at);
	  		var date = moment(dateRough).format('YYYY-MM-DD HH:mm:ss'); //Format date:time for excel (differs from that needed for chart api)
	  		var value = parseFloat(unsortedData[j].rawData[k].value);
	  		csvContent = csvContent + date + "," +value +"\n";
	  		parsedData[k] = {x: dateRough.unix(), y: value};
		}
								
		unsortedData[j].csv.csvContent	= csvContent;
		unsortedData[j].csv.uri			= encodeURI(unsortedData[j].csv.csvContent); 
		unsortedData[j].cleanData	 	= parsedData;		
	}
}

function calculateStats(){

	for ( var j = 0; j < unsortedData.length; j++){
		var yValues = [];
		for ( 	var m = 0; m< unsortedData[j].cleanData.length; m++ ){
			yValues.push(unsortedData[j].cleanData[m].y);
		}
		
		var mean 		= jsStats.mean(yValues);
		var median 		= jsStats.median(yValues);
		var mode 		= jsStats.mode(yValues);
		var min 		= jsStats.min(yValues);
		var max 		= jsStats.max(yValues);
		var variance 	= jsStats.variance(yValues);
		//var stddev 		= jsStats.stddev(yValues); 
		var stats 		= { mean: mean, median: median, mode: mode, min: min, max: max, variance: variance }
		unsortedData[j].stats = stats;
		unsortedData[j].max = stats.max;
		unsortedData[j].min = stats.min;
	}
}

function getAllDataStreams(theFeedInfo){
	var myDataStreams = [];
	for (i = 0; i < theFeedInfo.length; i++) { 
		var currentObj = theFeedInfo[i];
		if (currentObj.hasOwnProperty("datastreams")){
			for (j = 0; j < currentObj.datastreams.length; j++) { 				
				if ( notStatusStreams(currentObj.datastreams[j])){	
					if (currentObj.datastreams[j].hasOwnProperty("current_value")){
						var dataStream = {
							feedId: 	currentObj.id,
							id: 		currentObj.datastreams[j].id,
							label: 		niceLabel(currentObj.datastreams[j].id),							
							value: 		currentObj.datastreams[j].current_value,
							time: 		currentObj.datastreams[j].at,
							max:		0.1,
							min:		0,
							col:		getColor(i),
							rawData: 	[],
							cleanData: 	[],
							tags: 		[],
							stats:		[],							
							symbol: 	"",
							channel: 	"",
							csv:		{
											uri: 			"", 
											csvContent: 	""
										},
							location: 	{	
											name: 			currentObj.location.name,
											lat: 			currentObj.location.lat,
											lon: 			currentObj.location.lon								
							}
						};
						
						if(currentObj.datastreams[j].hasOwnProperty("tags")){
							dataStream.tags = currentObj.datastreams[j].tags;
						}
						
						if ( currentObj.datastreams[j].hasOwnProperty("unit")){
							if ( currentObj.datastreams[j].unit.hasOwnProperty("symbol")){
								dataStream.symbol = niceSymbol(currentObj.datastreams[j].unit.symbol);
								if (currentObj.tags.indexOf("Sciencescope") > -1){		
									dataStream.channel = "Ch: " +dataStream.id.slice(0,1);
									dataStream.label = niceLabel(currentObj.datastreams[j].unit.label);
								}														
							}							
						}						
						myDataStreams.push(dataStream);
					}
				}
			}
		}	
	}
	if (myDataStreams.length == 0){
		console.log("We have a problem. No live sensors at the moment");
	}
	return myDataStreams;
}

function niceSymbol(mySymbol){
	var superScript = mySymbol.indexOf("-");
	if ( superScript > -1){mySymbol = mySymbol.substr(0, superScript) + "<sup>" + mySymbol.substr(superScript) +"</sup>" ;}
	
	if (mySymbol == "deg C" || mySymbol == "Cel" ){ mySymbol = "&deg; C"; }
	else if (mySymbol == "deg"){ mySymbol = "&deg;";}
	else if (mySymbol == "delta K"){ mySymbol = "&Delta; K"; }
	else if (mySymbol == "ppm (CO2)"){mySymbol = "ppm (CO<sub>2</sub>)";}
	else if (mySymbol == "m/s"){mySymbol = "ms<sup>-1</sup>";}
	else if (mySymbol == "hPa"){mySymbol = "mBarr";}	
	else if (mySymbol == "W/m^2"){mySymbol = "W<sup>-2</sup>";}	
	//else if (mySymbol == "mm/hr"){mySymbol = "mm<sup>-1</sup>";}	
	return mySymbol;
}

function niceChannel(myLabel){
	//Add Inside to ch for intel Weather Stations.	
	console.log("Work to be done in niceChannel");
}

function niceLabel(myLabel){
	var myLabel = myLabel.replace(/_/g, " ");
	
	if (myLabel == "meters per second"){ myLabel = "Wind Speed"; }
	else if (myLabel == "Light"){ myLabel = "Light level"; }
	else if (myLabel == "Degrees"){	myLabel = "Wind Direction";}
	else if (myLabel == "Air Pressure"){ myLabel = "Atmospheric pressure";}
	else if (myLabel == "Rainfall Total"){ myLabel = "Rainfall";}
	else if (myLabel == "Outside air temperature" || myLabel == "Inside air temperature" || myLabel == "Air Temperature" )
		{ myLabel = "Temperature";}
	else if (myLabel == "Inside humidity" || myLabel == "Outside humidity" || myLabel == "Relative Humidity"){ myLabel = "Humidity";}
	return myLabel;
}

function removeEmptyStreams(){
	var removeArray = [];
	//Find Empty Data Sets
	for (var j = 0; j< unsortedData.length; j++){
		if (unsortedData[j].rawData.length == 0){
			removeArray.push(j);
		}
	}
	
	for ( var j = 0; j< removeArray.length; j++){
		removedData.push(unsortedData.splice(removeArray[j]-j,1));
	}
	console.log("RemovedItems");
	console.log(removedData);
}

function progressMsg( details ){
	var progressDiv = document.getElementById('header');
	
	if (details == "clear"){
		progressDetails = "";	
	}
	else{
		progressDetails += details;
	}	
	progressDiv.innerHTML = progressDetails;
}

function dataLoadedMsg(details){
	var progressDiv = document.getElementById('header');
	loadingDetails = details;
	progressDiv.innerHTML = progressDetails + loadingDetails;	
}

function initialseJQueryObjects(){
    $(".graphXSlider").slider({range: true});
	$( ".csvButton" ).button();
	$( ".graphControls" ).tabs();
    $( ".toggler" ).buttonset();	
}

function getCatalog(){
	var json = <?php echo $respJson?>;
	var parsedCat = JSON.parse(json);
	return parsedCat.results;	
}

function getStreamInfo(){		
	var dataStreams 	= [];	//Data for the devices selected obtained from the catalog	
	var catIndex 		= [];	//Searchable list of ids from catalog
	var results 		= getCatalog();	
	var feeds 			= getFeeds();
	
	for (var h = 0; h< results.length; h++){	catIndex.push(results[h].id);}
	for (var i = 0; i < feeds.length; i++){
		var listPos = catIndex.indexOf(parseInt(feeds[i]));		
		if (listPos > -1){	dataStreams.push(results[listPos]);	}
		else{	console.log(feeds[i] +" not a valid feedNumber as it isn't on the catalog.");}		
	}
	return dataStreams;
}

function sortDataStreams(myUnSortedStreams){
	var mySortedList = [];
	var myIndexList = [];
	
	for (i =0; i < myUnSortedStreams.length; i++){
		var myPos = myIndexList.indexOf(myUnSortedStreams[i].label);
		if (myPos == -1){
			myIndexList.push(myUnSortedStreams[i].label);
			var mySortedElement = {
				label: myUnSortedStreams[i].label,
				content: [myUnSortedStreams[i]],
				symbol:	myUnSortedStreams[i].symbol,
				min:	0,
				max:	0										
			};
			mySortedList.push(mySortedElement);			
		}
		else{
			mySortedList[myPos].content.push(myUnSortedStreams[i]); //Label Already exists need to push it into ab existing sortedElement
		}
	}
	return mySortedList;
}

function notStatusStreams(myObj){
	var myFeedId = myObj.id;
	if (myFeedId == "9999" 					||	myFeedId == "Battery_voltage_flag" 	||
		myFeedId == "DateTimeSwOpened" 		||	myFeedId == "DateTimeLogStarted" 	|| 
		myFeedId == "NumSessionLogs"		||	myFeedId == "DateTimeLogStopped"	||
		myFeedId == "DateTimeSwClosed"){
		return false;
	}
	else{return true;}	
}

function getData(data){
	//In future will break this into getXivelyData, getMetOfficeData etc.
	
	if (typeof data !== "undefined") {
	    if (data.hasOwnProperty("datapoints")){
			unsortedData[feedPointer].rawData = data.datapoints;    
			// max_value and min_value are not representative of the data returned so we will use the results returned by the stats 
			/*
			if (data.hasOwnProperty("max_value"))unsortedData[feedPointer].max = data.max_value;
			if (data.hasOwnProperty("min_value"))unsortedData[feedPointer].min = data.min_value;
			*/				
	    }
	    else{
		    console.log("No data points present");
	    }		    
	    feedPointer+= 1;
	    var perCent = parseInt(feedPointer/(unsortedData.length)* 100);
 
	   	$( "#progressbar" ).progressbar({value: perCent});
	    dataLoadedMsg( "<br>Downloaded: " +perCent +"% of data" );


	} 
	else {
	    // argument not passed or undefined e.g 1st time around!
	}
	
	if ( feedPointer < unsortedData.length ){		
		xively.datastream.history (unsortedData[feedPointer].feedId, unsortedData[feedPointer].id, query, getData); 
	}
	else{
		progressMsg("<br>All Data Retrieved.<br>");		
		mainFlow();
	}
}
		
//Generic Functions
function getFeeds(){
	var feedIDs = "<?php echo $feedno; ?>";
	/* 
		Change needed here 
		- grab the live feeds list or first element of - get last 5 - 7 days?
	*/
	
	if ( feedIDs == "") feedIDs ="1734847623";
	
	//Php Will return a string rather than an array.
	var feedIDarray = feedIDs.split(",");
	return feedIDarray;
}

function getStartEnd(){

	var timeRange = {start:"<?php echo $startT; ?>", end: "<?php echo $endT; ?>" };	
	/* 
		Change needed here 
		- Set to last 5 - 7 days
	*/
	
	if (timeRange.start == ""){
		timeRange = {start: "2014-02-22T14:35:04+00:00", end: "2014-02-27T14:35:04+00:00" };
	}
	return timeRange;
}

function getColors(){
	colors = [
				"#F15854", //Red
				"#5DA5DA", //Blue
				"#60BD68", //Green
				"#FAA43A", //Orange
				"#B276B2", //Purple
				"#B2912F", //Brown
				"#F17CB0", //Pink
				"#4D4D4D", //Gray
				"#DECF3F", //Yellow
			];
	return colors;
}

function getColor(i){
	// Colors will loop
	var colors = getColors();
	var index =  i % colors.length;
	return colors[index];
}



</script>
</head>
<body>
<!-- HTML -->
<div id="headerImg" style="background-color: #FFBF00;">&nbsp;<br>
	<h2><img src="images/logo.png"><font color="Maroon"> Exploratory</font></h2><br>
</div>

<div id ="loading">
	<div id ="header" style="margin: 10;"></div>
	<div id="progressbar" style="width:80%; margin: 10;"></div>
</div>

<div id = "container"></div>
<div id = "Footer"></div>
<div id = "testDiv"></div>

</body>
</html>