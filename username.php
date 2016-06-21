<?php  session_start(); ?>
<?php  ini_set('display_errors', 'on') ?>
<?php  include 'IHD.php'; ?>
<?php
		
		
		
	$username = NULL;
	$password = NULL;
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if(isset($username, $password))
	{
		$mysqli = new mysqli($dbhost, $dbname, $dbpass, $dbuser);

			if(!$mysqli || $mysqli->connect_errno)
			{
				echo "connection error".$mysqli->connect+errno."".$mysqli->connect_error;
				exit();
			}
			else
				//echo "connection works!<br>";
	
		$check = $mysqli->query("SELECT * FROM logon WHERE username='$username' ");
	
		$numrows = $check->num_rows;
	
		if($numrows !=0)
		{
			//code to log in. 
			while ($row = $check->fetch_assoc())
			{
				$dbusername = $row['username'];
				$dbpassword = $row['password'];
				
			}
			//check to see if they match
			if (strcmp($username, $dbusername) == 0 && strcmp($password, $dbpassword)==0)
			{
				
				echo 1;
				
				$_SESSION['username'] = $username;
			}
			else
				echo 0;
		
		}
		else
		{
			echo 3;
			
		}
	
	
	
		$check->close();
		$mysqli->close();
	}
	
	
	
	?>