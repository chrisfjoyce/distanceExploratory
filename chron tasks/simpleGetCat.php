<?PHP
	$username = "Iostp";
	$password = "IOSTPxively";
	$remote_url = 'https://api.xively.com/v2/feeds.json?user=Iostp&per_page=200&tag=L1v3';
	
	// Create a stream
	$opts = array(
	  'http'=>array(
	    'method'=>"GET",
	    'header' => "Authorization: Basic " . base64_encode("$username:$password")                 
	  )
	);
	
	$context = stream_context_create($opts);
	$myFile = "superCat.txt";
	$fh = fopen($myFile, 'w') or die("can't open file");
	fwrite($fh, file_get_contents($remote_url, false, $context));

	
	fclose($fh);
?>