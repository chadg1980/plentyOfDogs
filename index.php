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



<!-- Start WOWSlider.com HEAD section -->
	<link rel="stylesheet" type="text/css" href="engine1//style.css" media="screen" />
	<script type="text/javascript" src="engine1//jquery.js"></script>
<!-- End WOWSlider.com HEAD section -->

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
	

<!-- Start WOWSlider.com BODY section id=wowslider-container1 -->
	<div id="wowslider-container1">
	<div class="ws_images"><ul>
<li><img src="data1/images/img2.jpg" alt="Snoopy" title="Snoopy" id="wows1_0"/>rescue dog</li>
<li><img src="data1/images/img1.jpg" alt="peppers" title="peppers" id="wows1_1"/>puppy needs a good home</li>
<li><img src="data1/images/img4.jpg" alt="bowser" title="bowser" id="wows1_2"/>designated driver trained</li>
<li><img src="data1/images/img5.jpg" alt="charlie" title="charlie" id="wows1_3"/>Family Friendly</li>
</ul></div>
<div class="ws_bullets"><div>
<a href="#" title="Snoopy"><img src="data1/tooltips/img2.jpg" alt="Snoopy"/>1</a>
<a href="#" title="peppers"><img src="data1/tooltips/img1.jpg" alt="peppers"/>2</a>
<a href="#" title="bowser"><img src="data1/tooltips/img4.jpg" alt="bowser"/>3</a>
<a href="#" title="charlie"><img src="data1/tooltips/img5.jpg" alt="charlie"/>4</a>
</div></div>
<span class="wsl"><a href="http://wowslider.com">Web Page Slideshow</a> by WOWSlider.com v5.2</span>
	<a href="#" class="ws_frame"></a>
	<div class="ws_shadow"></div>
	</div>
	<script type="text/javascript" src="engine1//wowslider.js"></script>
	<script type="text/javascript" src="engine1//script.js"></script>
<!-- End WOWSlider.com BODY section -->

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
