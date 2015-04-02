<html>
	<head>
		<meta charset="utf-8">
		<title>Distance Exploratory Dashboard</title>
			
		<?php
			$response = file_get_contents('http://chrisfjoyce.com/superCat.txt');
			$response = utf8_encode($response); 
			$respJson = json_encode($response);			
		?>
		
	<link href="css/sunny/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">
	<link href="css/dataTablesNice.css" rel="stylesheet">	
	
	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/jquery-ui-1.10.4.custom.min.js"></script>
	<script src="js/jquery.dataTables1.9.4.min.js"></script>

	<!-- Map Box Links -->
	
	<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />
	<script src='https://api.tiles.mapbox.com/mapbox.js/v1.6.1/mapbox.js'></script>
	<script src='http://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/leaflet.markercluster.js'></script>
	<link href='https://api.tiles.mapbox.com/mapbox.js/v1.6.1/mapbox.css' rel='stylesheet'/>
	<link href='http://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.css' rel='stylesheet' />
	<link href='http://api.tiles.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v0.4.0/MarkerCluster.Default.css' rel='stylesheet' />	

	<!-- <link href="index.css" rel="stylesheet"> Remove CSS -->		
	
	<script>
	// Set up JQuery Elements
	$(function() {
		$( "#button" ).button();
		$( "#radioset" ).buttonset();
		$( ".lists" ).buttonset();													
		$( "#startDate" ).datepicker({ 	maxDate: new Date, minDate: new Date(2014, 1, 1) });		
		$( "#numDays" ).spinner({ min: 0, max: 9});
		$( document ).tooltip();		
		//$( "#dataInterval" ).selectmenu();
	});
	</script>	
	
	<style>
	select { width: 200px; } 
		
	.filter-ui {
		background:#fff;
		position:absolute;
		top:10px;
		right:10px;
		z-index:100;
		padding:10px;
		border-radius:3px;
	}	
		
	#tooltip
	{
	    text-align: center;
	    color: #fff;
	    background: #111;
	    position: absolute;
	    z-index: 100;
	    padding: 15px;
	}

 
    #tooltip.top:after
    {
        border-top-color: transparent;
        border-bottom: 10px solid #111;
        top: -20px;
        bottom: auto;
    }

    #tooltip.left:after
    {
        left: 10px;
        margin: 0;
    }

    #tooltip.right:after
    {
        right: 10px;
        left: auto;
        margin: 0;
    }	
		
	#map { height: 320px; width: 480px; }
	caption {
		text-align: left;
		background-color: #FFBF00;
	}
		
	th { background-color: #3577FF;}
	
	body{
		font: 75% "Trebuchet MS", sans-serif;
		margin: 2px;
	}
	.demoHeaders {
		margin-top: 2em;
	}
	#dialog-link {
		padding: .4em 1em .4em 20px;
		text-decoration: none;
		position: relative;
	}
	#dialog-link span.ui-icon {
		margin: 0 5px 0 0;
		position: absolute;
		left: .2em;
		top: 50%;
		margin-top: -8px;
	}
	#icons {
		margin: 0;
		padding: 0;
	}
	#icons li {
		margin: 2px;
		position: relative;
		padding: 4px 0;
		cursor: pointer;
		float: left;
		list-style: none;
	}
	
	#icons span.ui-icon {
		float: left;
		margin: 0 4px;
	}
	
	
    #headerImg{ background-color: #FFBF00; }    
	ul{ list-style-type: none;}

	
	
			
	</style>
	

	</head>
	<body>
	<div id="headerImg">&nbsp;<br>
		<h2><img src="images/logo.png"><font color="Maroon"> Exploratory</font></h2><br>
	</div>
	<br>	
	
	<div id="aboutTabs">
	<ul>
		<li rel="tooltip" title="Status of Sensors."><a href="#deviceStatus">Device Status</a></li>
		<li rel="tooltip" title="About Distance Project."><a href="#distanceAbout">About</a></li>
		<li rel="tooltip" title="Help"><a href="#distanceHelp">How to use this App.</a></li>
	</ul>
	<div id="deviceStatus">
			<div id ="container">
		<h3><b>Live Devices</b></h3>
		<nav id='filters' class='filter-ui'></nav>		
		<div id="map"></div>
		<div id="dynamic"></div>				
		
	</div>	
	</div>
	<div id="distanceAbout">
		<h3><font color="maroon">Distance Exploratory</font></h3> is an experimental platform/app built to support the DISTANCE project. A project which aims to bring together a series of Internet 			connected objects to enhance the classroom experience. 
		<br>The app provides current sensor readings and graphs historic data sets to enable schools and their environs to be understood better. 			<br>
		
		<h3><font color="maroon">Further details:</font></h3> of the project can be found in the following papers and websites:<br>
		<ol>	
			<li>Chris Joyce, Han Pham, Danae Stanton Fraser, Stephen Payne, David Crellin, and Sean McDougall. 2014. <b>Building an internet of school 			things ecosystem: a national collaborative experience.</b> In Proceedings of the 2014 conference on Interaction design and children (IDC '14). 			ACM, New York, NY, USA, 289-292. DOI=10.1145/2593968.2610474 <a href ="http://doi.acm.org/10.1145/2593968.2610474">http://doi.acm.org/				10.1145/2593968.2610474</a>
			</li><br>
			<li>
			<a href="http://blog.xively.com/2013/08/21/distance-launches-the-internet-of-school-things-an-international-collaboration-focused-on-				advancing-education-through-new-technology/">DISTANCE Launches the Internet of School Things</a> (Press release from Xively August 2013)
			</li><br>
			<li><a href ="http://www.telegraph.co.uk/technology/news/10255630/Eight-UK-schools-to-take-part-in-Internet-of-Things-pilot.html"> Eight UK 			schools to take part in 'Internet of Things' pilot.</a> Article from the Daily Telegraph (August 2013)
			</li><br>
			<li>DISTANCE, Demonstrating the Internet of School Thing - A National Collaborative Experience (UK) - 
			<a href="http://www.rsc.org/learn-chemistry/resource/res00001527/distance-using-the-internet-of-school-things?cmpid=CMP00004099"> 					Atmospheric monitoring and more. </a>Teaching resources from the Royal Society of Chemistry.
			</li>
			
		</ol>				

		
	</div>
	<div id="distanceHelp">
		Youtube video Placeholder.
	<!	<object width="420" height="315" data="https://www.youtube.com/watch?v=MAugIkMolss"></object> -->
	</div>
	</div>
	
	<h2 class="demoHeaders">Build Graphs</h2>


<div id="buildTabs">
	<ul>
		<li rel="tooltip" title="Select data from a list of available devices."><a href="#deviceList">1) Select Data Sources</a></li>
		<li rel="tooltip" title="Select the start and end date for the devices selected."><a href="#dateSelection">2) Select Dates for the data </a></li>	
		<li rel="tooltip" title="Select a pre-made Graphs."><a href="#premadeGraph">Pre-made Graphs</a></li>
	</ul>

	<div id="deviceList" class ="lists"></div>
	<div id="dateSelection">

		<h2 class="demoHeaders">Range of dates</h2>Once you have the devices selected which you are interested in, choose the start date and the number 		of days subsequent days of data that you are interested in.
		
					
		<p>Start Date: <input type="text" id="startDate" readonly="true"></p>
		
		<p>
		<label for="numDays">Additional Days:</label>
		<input id="numDays" name="value" readonly="true">
		</p>

		<!--		
		<form action="#">
			<label for="dataInterval">Data point interval</label>
			<select name="dataInterval" id="dataInterval" class="demoHeaders">
				
				<option>Every Minute</option>
				<option>Every 5 Minutes</option>
				<option selected="selected">Every 15 Minutes</option>
				<option>Every 30 Minutes</option>
				<option>Every 60 Minutes</option>
				<option>Every 3 Hours</option>			
				<option>Every 6 Hours</option>			
				<option>Every 12 Hours</option>						
				<option>Every 24 Hours</option>									
			</select>
		</form>
		-->
		
		<br>&nbsp;
		<br>&nbsp;												
		<button onclick="loadFeedData()" id="button" 
			rel="tooltip" title="Make sure you have the correct devices and time range selected before clicking this."> Generate Graphs
		</button>

	</div>

	<div id="premadeGraph">
			<h3>Pre-made Graphs</h3>
	<div>
		<ul>
			<li><a href="../GPRSLogbook/index.htm" target="_blank">GPRS Log Book Status Page</a></li>			
			<li><a href="smartStreets.php" target="_blank">Smart Streets Catalog</a></li>
			<li><a href="streetLights.php"target="_blank">Street Lights London from IoT-Bay <i>(20k + lights so this will take a few seconds to load)
			</i></a></li>			
	  	</ul>

	</div>
	


</div>



<div>&nbsp;<br></div>



<!-- Slider 

<div id="accordion"></div>
-->


</div>

<h2 class="demoHeaders">Current Values for Live Devices</h2>
<div id ="sensorTabs"></div>

<div id="head"></div>

	
	<script src="js/moment.min.js"></script>			
	<script type="text/javascript">
		
	var sensorRecord 		= [];
	var sensorRecords 		= [];
	var feedList			= [];
	var extFeedList			= [];
	

	
		
	$(window).load(function(){
		$( ".startDate" ).datepicker({ defaultDate: new Date() });	    
	    var json = <?php echo $respJson?>;
		var parsedCat = JSON.parse(json);
		var results = parsedCat.results;
		console.log(results);
		
		var devices = liveorDeadDevices(results);
		createDeviceList(devices.live);
		
		var dataStreams =  getDataStreamList(results);
		var sensorSortedDataStreams = sensorSortDataStreams(dataStreams);
		displaydata(sensorSortedDataStreams);
		
		var dataSet = assembleSensorTableBody(dataStreams);			
		assembleSensorTable();
		assembleSensorMap(dataStreams);
	
		
		//Initialise JQuery Objects
		$( "#sensorTabs" ).tabs();		
		$( "#numDays" ).spinner( "value", 1 );
		$( "#startDate").datepicker("setDate",new Date()); 
		$( "#startDate" ).datepicker( "option", "dateFormat", "dd-mm-yy" );
		
		$( "#aboutTabs" ).tabs();
		$( "#fakeTabs" ).tabs();		
		$( "#buildTabs" ).tabs();		
		
		//Label & content							
		
		$('.lists :checkbox').click(function() {
		    var $this = $(this);		
			//Check to see if item is on list already if so - remove it - will add it if it's a select Operation
	
			if (this.id.length > 30){
				//Dealing with an external Feed!
				for (var i=extFeedList.length-1; i>=0; i--) {
				    if (extFeedList[i] === this.id) {
				        extFeedList.splice(i, 1);
					}
				}	    
				if ($this.is(':checked')) { extFeedList.push(this.id);	} 			
			}
			else{
				for (var i=feedList.length-1; i>=0; i--) {
				    if (feedList[i] === this.id) {
				        feedList.splice(i, 1);
					}
				}	    
				if ($this.is(':checked')) { feedList.push(this.id);	} 
			}
		});
		
		var targets = $( '[rel~=tooltip]' ),
        target  = false,
        tooltip = false,
        title   = false;
 
	    targets.bind( 'mouseenter', function()
	    {
	        target  = $( this );
	        tip     = target.attr( 'title' );
	        tooltip = $( '<div id="tooltip"></div>' );
	 
	        if( !tip || tip == '' )
	            return false;
	 
	        target.removeAttr( 'title' );
	        tooltip.css( 'opacity', 0 )
	               .html( tip )
	               .appendTo( 'body' );
	 
	        var init_tooltip = function()
	        {
	            if( $( window ).width() < tooltip.outerWidth() * 1.5 )
	                tooltip.css( 'max-width', $( window ).width() / 2 );
	            else
	                tooltip.css( 'max-width', 340 );
	 
	            var pos_left = target.offset().left + ( target.outerWidth() / 2 ) - ( tooltip.outerWidth() / 2 ),
	                pos_top  = target.offset().top - tooltip.outerHeight() - 20;
	 
	            if( pos_left < 0 )
	            {
	                pos_left = target.offset().left + target.outerWidth() / 2 - 20;
	                tooltip.addClass( 'left' );
	            }
	            else
	                tooltip.removeClass( 'left' );
	 
	            if( pos_left + tooltip.outerWidth() > $( window ).width() )
	            {
	                pos_left = target.offset().left - tooltip.outerWidth() + target.outerWidth() / 2 + 20;
	                tooltip.addClass( 'right' );
	            }
	            else
	                tooltip.removeClass( 'right' );
	 
	            if( pos_top < 0 )
	            {
	                var pos_top  = target.offset().top + target.outerHeight();
	                tooltip.addClass( 'top' );
	            }
	            else
	                tooltip.removeClass( 'top' );
	 
	            tooltip.css( { left: pos_left, top: pos_top } )
	                   .animate( { top: '+=10', opacity: 1 }, 50 );
	        };
	 
	        init_tooltip();
	        $( window ).resize( init_tooltip );
	 
	        var remove_tooltip = function()
	        {
	            tooltip.animate( { top: '-=10', opacity: 0 }, 50, function()
	            {
	                $( this ).remove();
	            });
	 
	            target.attr( 'title', tip );
	        };
	 
	        target.bind( 'mouseleave', remove_tooltip );
	        tooltip.bind( 'click', remove_tooltip );
	    });		
	});	
	
	function assembleSensorMap(mapDataStreams){		
		
		var map = L.mapbox.map('map', 'chrisfjoyce.l8e99hj4', {
			maxZoom: 19,
			minZoom: 5
		}).setView([52, -4], 6);
		
		map.scrollWheelZoom.disable();			
		map.dragging.disable();	    
		map.addControl(L.mapbox.infoControl());
		map.infoControl.addInfo("ScienceScope 2015");
		
		var markers = new L.MarkerClusterGroup();
		for (var i = 0; i < mapDataStreams.length; i++) {


			var a = mapDataStreams[i];
			//console.log(a);
			var myStart = moment().format('YYYY MM DD');
			
			var myEnd = moment();

			var title = "<b><font color=\"#3ca0d3\">" + a.location.name +"</b></font><br>" 
							+ a.channel + " " + a.label + "<br>" +a.value + " " +a.symbol
							+"<br><font color=\"#3ca0d3\"><i>Tags</i></font><br>"
							+ a.tags							
							+"<br><font color=\"#3ca0d3\"><i>Data</i></font><br>" 
							+ "<a target=\"_blank\"  href=\"" +"generic.php?feedId="  +a.href 
							+"& start="+moment.utc(myStart).format()+"&end="+moment.utc(myEnd).format()
							+"\"><font color = \"#000\"><u>View Data since midnight</a>";
			var marker = L.marker(new L.LatLng(a.location.lat, a.location.lon), {
			icon: L.mapbox.marker.icon({'marker-symbol': 'star', 'marker-color': '#f86767'}),
			title: title });
			
			marker.bindPopup(title);
			markers.addLayer(marker);
			
		}
		map.addLayer(markers);
	}
	
	function assembleSensorTable(){
	$('#dynamic').html( '<table cellpadding="0" cellspacing="0" border="0" class="pretty" id="myDataTable"></table>' );
	$('#myDataTable').dataTable( {
			"aaData": sensorRecords,
			"aoColumns": [
				{ "sTitle": "Sensor" },
				{ "sTitle": "Location" },
				{ "sTitle": "Value" },
				{ "sTitle": "Time" },
				{ "sTitle": "Tags" }	
			]
		} );
	}
	
	function assembleSensorTableBody(myDataStreams){

		for (var p =0; p < myDataStreams.length; p++ ){
			sensorRecord = [	myDataStreams[p].label, 
								myDataStreams[p].location.name + " " +myDataStreams[p].channel,
								myDataStreams[p].value + " (" +myDataStreams[p].symbol	+")",
								moment(myDataStreams[p].time).fromNow(),
								myDataStreams[p].tags
								];			
			sensorRecords.push(sensorRecord);
		}
		return sensorRecords;
	}
	
	function displaydata(sortedData){		
		//Function builds the sensor tab with all the values from fresh devices. Each sensor type is given a tab.
		headerString = "<ul>";
		dataString = "";
		for (k = 0; k< sortedData.length; k++ ){			
			var myLabel = sortedData[k].label.replace(/ /g, "_");	//Divs can't have spaces so replace them with underscores.						
			headerString += "<li><a href=\"#" +myLabel +"\">" +sortedData[k].label +"</a></li>";			
			dataString += 	"<div id=\"" +myLabel +"\" class=\"lists\">"
							+"<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"pretty\">"
							+ "<caption align=\"left\">"+sortedData[k].label +"</caption><tr>"
							+ "<th align=\"left\">Location</th>"
							+ "<th align=\"left\">Value</th>"
							//+ "<th align=\"left\">Unit</th>"
							+ "<th align=\"left\">Time</th>"
							+ "</tr>";
							
			for (l= 0; l< sortedData[k].content.length; l++){
				dataString += "<tr><td>"	+sortedData[k].content[l].location.name + " " +sortedData[k].content[l].channel
								+"</td><td>"+sortedData[k].content[l].value	+ " (" +sortedData[k].content[l].symbol	+")"
								//+"</td><td>"+sortedData[k].content[l].symbol
								+"</td><td>"+moment(sortedData[k].content[l].time).fromNow()								
								+"</td></tr>";
			}
			dataString += "</table><br></div>";			
		}
				
		headerString += "</ul>";
		document.getElementById("sensorTabs").innerHTML = headerString + dataString;
		$("sensorTabs").tabs("refresh");
	}
	
	function loadFeedData(){

		var dateMin = $( startDate ).datepicker( "getDate" );
		var myDays = parseInt( $("#numDays" ).spinner("value"));
		var dateMax = moment().add(myDays, 'days');
		
		if ( moment(dateMax).isAfter(moment()) ==true){
			console.log("User has requested time in Future for end point so start point will be brought backwards.");
			var daysToSub = dateMax.diff(moment(), 'days') + 1;	
			dateMin = moment(dateMin).subtract(daysToSub, 'days');
			dateMax = moment();	//Set this to now
		}
			
		if (feedList.length == 0 && extFeedList.length == 0){
			alert("Please select a device first.");
		}
		else{			
			var feedArgs = "";
			if (feedList.length > 0) 	feedArgs += "feedId="	+feedList.toString() +"&";
			if (extFeedList.length > 0) feedArgs += "extFeedId=" +extFeedList.toString() + "&";
			feedArgs += "start="+moment.utc(dateMin).format()+"&end="+moment.utc(dateMax).format();	
			window.open("generic.php?"+feedArgs);
		}
	}

	
	function getDataStreamList(myResults){
		var myDataStreams = [];
		for (i = 0; i < myResults.length; i++) { 
			var currentObj = myResults[i];
			if (currentObj.status =="live")	{
				if (currentObj.hasOwnProperty("datastreams")){
					for (j = 0; j < currentObj.datastreams.length; j++) { 				
						if ( notStatusStreams(currentObj.datastreams[j])){	
							if (currentObj.datastreams[j].hasOwnProperty("current_value")){
								var dataStream = {
									id: currentObj.datastreams[j].id,
									href: currentObj.id,
									label: currentObj.datastreams[j].id,
									channel: "",	//ScienceScope Only Attribute
									location: {	
										name: currentObj.location.name,
										lat: currentObj.location.lat,
										lon: currentObj.location.lon								
									},
									value: currentObj.datastreams[j].current_value,
									time: currentObj.datastreams[j].at,
									tags: [],
									symbol: ""
								};
								
								if(currentObj.datastreams[j].hasOwnProperty("tags")){
									dataStream.tags = currentObj.datastreams[j].tags;
								}
								
								if ( currentObj.datastreams[j].hasOwnProperty("unit")){
									if ( currentObj.datastreams[j].unit.hasOwnProperty("symbol")){
										dataStream.symbol = currentObj.datastreams[j].unit.symbol;
										if (currentObj.tags.indexOf("Sciencescope") > -1){		
											dataStream.channel = "Ch: " +dataStream.id.slice(0,1);
											dataStream.label = currentObj.datastreams[j].unit.label;
										}														
									}							
								}						
								myDataStreams.push(dataStream);
							}
						}
					}
				}
			}
		}
		if (myDataStreams.length == 0){
			//console.log("We have a problem. No live sensors at the moment");
		}
		return myDataStreams;
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
	
	function sensorSortDataStreams(myUnSortedStreams){
		//console.log("Number of unsorted streams:" +myUnSortedStreams.length);
		var mySortedList = [];
		var myIndexList = [];
		
		for (i =0; i < myUnSortedStreams.length; i++){
			var myPos = myIndexList.indexOf(myUnSortedStreams[i].label);
			if (myPos == -1){
				myIndexList.push(myUnSortedStreams[i].label);
				var mySortedElement = {
					label: myUnSortedStreams[i].label,
					content: [myUnSortedStreams[i]]										
				};
				mySortedList.push(mySortedElement);			
			}
			else{
				mySortedList[myPos].content.push(myUnSortedStreams[i]);
				//Label Already exists need to push it into ab existing sortedElement
			}
		}
		return mySortedList;
	}
	
	function liveorDeadDevices(myResults){

		var liveDevices = [];
		var deadDevices = [];
		
		for (i = 0; i< myResults.length; i++){
			devTime = moment(myResults[i].updated).fromNow(true);
			if (devTime.indexOf("month") > -1 || devTime.indexOf("year") > -1 ){
				deadDevices.push(myResults[i]);			
			}
			else{
				liveDevices.push(myResults[i]);
			}
		}
		var myDevices = {
			live: liveDevices,
			dead: deadDevices	
		};

		return myDevices;
	}
	
	function createDeviceList(myDevices){
		var devHtml = "";
		var liveHtml = "<h3>Devices with fresh data <i>(less than 30 mins old)</i></h3><ul>";
		var deadHtml = "</ul><br><h3>Other Devices</h3><ul>";
		for (i = 0; i< myDevices.length; i++)
		{
			currentObj = myDevices[i];
			if (currentObj.hasOwnProperty("datastreams")){	
				

				
				hasCoords = false;
				locName ="Location Unknown";
				feedHref = currentObj.id;
				feedType = currentObj.title;
				var isSciScope = currentObj.tags.indexOf("Sciencescope");
				
				var htmlStreams = "";
				for (j = 0; j < currentObj.datastreams.length; j++)
				{
					if (notStatusStreams(currentObj.datastreams[j])){
						if (currentObj.datastreams[j].hasOwnProperty("unit")){							
							if( notStatusStreams(currentObj.datastreams[j].unit.label)){
								//Need devce specfc cde fr BCL etc and remve dplcates
								htmlStreams += currentObj.datastreams[j].unit.label + ", ";
							}
						}
					}
				}
				htmlStreams = htmlStreams.substr(0,htmlStreams.length -2); //C-mma rem-val f-r last -tem
				
				
				if (hasLocation(currentObj)){
					locName  = currentObj.location.name; 
					if (currentObj.location.hasOwnProperty("lat")){
						hasCoords = true;
					}
				}
				seg = 		"<li rel=\"tooltip\" title=\""
							+htmlStreams
							+"\" class =\"listedDevice\">"
							+"<input type=\"checkbox\" id=\"" 
							+feedHref +"\"><label for=\"" +feedHref +"\">" 
							+locName 
							+" <font color=\"Maroon\"><i>(" + moment(currentObj.updated).fromNow(true) +")</i></font color>";
				if ( currentObj.status =="live"){ liveHtml += seg; }
				else{ deadHtml += seg; }
			}
			devHtml = liveHtml + deadHtml + "</ul>";
			document.getElementById("deviceList").innerHTML = devHtml;	
		}
		
	}
	
	function hasLocation(myObj){
	if (myObj.hasOwnProperty('location')){
		if (myObj.location.hasOwnProperty('name')){
			return true;
		}
		else
			return false;
	}
	else 
		return false;
	}
	
	</script>
	
	</body>
</html>