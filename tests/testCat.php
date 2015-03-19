<html>
	<head>
		<meta charset="utf-8">
		<title>Distance Exploratory Dashboard</title>
			
		<?php
			$response = file_get_contents('http://chrisfjoyce.com/superCat.txt');
			$response = utf8_encode($response); 
			$respJson = json_encode($response);			
		?>
		<script type="text/javascript">
			var json = <?php echo $respJson?>;
			var parsedCat = JSON.parse(json);
			var results = parsedCat.results;
			console.log(results);
		</script>
	</head>
</html>