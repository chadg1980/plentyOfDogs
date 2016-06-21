<?php session_start();
if(!isset($_SESSION['username']))
	{
		header("Location: shelterlogin.html");
	}


?>
<!DOCTYPE html>
<HTML>

<head>
<!-- Remove Display Errors Before Publishing-->

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
		
	<form action ="shelteradmin.php" method="post">
		<table id="enter_dogs">
			<tr>
			<th>Dog's Name</th><th>Dog's age</th><th>Size of dog</th><th>Breed</th><th>Good with kids</th>
			
			</tr>
			<tr>
				<td><input type="text" name="dogname"></td>
				<td><input type="number" name="age"></td>
				<td><select name="size" >
					<option value="small">small </option>
					<option value="meduim">medium </option>
					<option value="large">large </option>
					<option value="xl">XL </option>
					</select>
				</td>
				<td><input type="text" name="breed"></td>
				<td><select name ="kids" >
					<option value ="yes"> yes </option>
					<option value = "no"> no </option>
					</select>
				</td>
				
			</tr>
			<tr><td><input type="submit"></td></tr>
		</table>
	</form>
		

	</div>
	
	<!-- dynamic div to display output-->
	<div id ="results" class="results">
	<?php
		
		
		$cur_user = $_SESSION['username'];
		$cur_shelter=NULL;
		$dog_name=$_POST['dogname'];
		$age=$_POST['age'];
		$size=$_POST['size'];
		$breed=$_POST['breed'];
		$kids=$_POST['kids'];
		
		
			include 'IHD.php';

			$mysqli = new mysqli($dbhost, $dbname, $dbpass, $dbuser);
	
	if(!$mysqli || $mysqli->connect_errno)
		echo "connection error".$mysqli->connect+errno."".$mysqli->connect_error;
		
	$get_shelter = $mysqli->query("SELECT * FROM logon WHERE username='$cur_user' ");
	
		$numrows = $get_shelter->num_rows;
	
		if($numrows !=0)
		{
			while ($row = $get_shelter->fetch_assoc())
			{$cur_shelter = $row['sheltername'];}
		}
		$get_shelter->close();
		
		
		
		$add_dog = $mysqli->prepare('
								INSERT INTO dogs (sheltername, username, dogname, age, size, breed, kids) 
								VALUES (?, ?, ?, ?, ?, ?, ?)');
			$add_dog->bind_param('sssisss', $cur_shelter, $cur_user, $dog_name, $age, $size, $breed, $kids);
			
			$add_dog->execute();
			$add_dog->close();
		
		
	$out_dogname = NULL;
	$out_age = NULL;
	$out_size=NULL;
	$out_breed=NULL;
	$out_kids=NULL;
	$row_id = NULL;
	
	$display = $mysqli->prepare("SELECT id, dogname, age, size, breed, kids FROM dogs WHERE username='$cur_user' ORDER BY id DESC LIMIT 200");
	$display->bind_result($row_id, $out_dogname, $out_age, $out_size, $out_breed, $out_kids);
	$display->execute();
	echo"<table id = 'display_table'><tr><th>name</th><th>age</th><th>size</th><th>breed</th><th>good with kids?</th></tr>";
	while($display->fetch())
	{
			
		echo "<tr>";
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
	<?php

		if(isset($_SESSION['username']))
			{
				echo "<ul><li>Welcome, $cur_user from $cur_shelter!</li>";
				echo"<li><a href='logout.php'>log out</a></li></ul>";
			}
		?>
		
	</div>

	
	<!-- FOOTER-->
	<div id="footer" class = "footer">
	
	<a href="index.php" id="pod" >Plenty of Dogs Main Page</a>
	</div>




</div>


</body>
</HTML>