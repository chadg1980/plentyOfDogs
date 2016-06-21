<?php  ini_set('display_errors', 'on') ?>
<!DOCTYPE html>
<HTML>

<head>
<script src="jquery.min.js"> </script>

<meta charset="utf-8">
<title>Plenty of Dogs</title>
<link 		rel="stylesheet" 
			type="text/css"
			href="pod.css">

</head>

<body>


	<!-- WRAPPER-->
	<div id="wrapper" class="wrapper" >

	<!-- HEADER-->
	<div id="header" class = "header" >
	<h1>Plenty of Dogs</h1>
	<img id="podheader" class="podheader" title="dogfamily" alt="dog with family" src="pics/podheader.jpg" >
	</div>


	<!-- Main Content-->
	<div id="center" class="center" >
	<h2> Dog's that are available at local shelter's</h2>
	</div>
	<div id="results" class="results">
	<?php
	include 'IHD.php';
	
	
		$mysqli = new mysqli($dbhost, $dbname, $dbpass, $dbuser);
			if(!$mysqli || $mysqli->connect_errno)
				echo "connection error".$mysqli->connect+errno."".$mysqli->connect_error;
		
	$out_dogname = NULL;
	$out_age = NULL;
	$out_size=NULL;
	$out_breed=NULL;
	$out_kids=NULL;
	$out_shelter = NULL;
	
	
	$display = $mysqli->prepare("SELECT sheltername, dogname, age, size, breed, kids FROM dogs ORDER BY id DESC LIMIT 200");
	$display->bind_result($out_shelter, $out_dogname, $out_age, $out_size, $out_breed, $out_kids);
	$display->execute();
	
	echo"<table id = 'display_table'> <tr><th>Shelter</th><th>name</th><th>age</th><th>size</th><th>breed</th><th>good with kids?</th>";
	while($display->fetch())
	{
			
		echo "<tr>";
			echo"<td>";
			printf("%s", $out_shelter);
			echo"</td>";
			
			
			
			echo"<td>";
			printf("%s", $out_dogname);
			echo"</td>";
			
			
			
			echo"<td>";
			printf("%d", $out_age);
			echo"</td>";
			
			
			
			echo"<td>";
			printf("%s", $out_size);
			echo"</td>";
			
			
			
			echo"<td>";
			printf("%s", $out_breed);
			echo"</td>";
			
			
			
			echo"<td>";
			printf("%s", $out_kids);
			echo"</td>";
		echo"</tr>";
			
			
			
		}
		echo"</table>";
		
	
	
		
		$display->close();
		
	
		
	?>
	</div>

	<!-- LEFT Hand nav Bar-->
	<div class ="lh" id ="lh">
	</div>

	
	<!-- FOOTER-->
	<div id="footer" class = "footer">
	<a href="shelterlogin.html" id="shelter" >Shelter admin<br> login</a>
	</div>




</div>


</body>
</HTML>