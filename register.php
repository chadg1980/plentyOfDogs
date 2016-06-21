<?php  
ini_set(session.save_path, '/nfs/stak/students/g/glaserc/public_html/sessions/');
session_start(); ?>

<?php  include 'IHD.php'; ?>


<?php

 

	
	
	
	
	$sheltername = $_POST['sheltername'];
	$usertitle = $_POST['title'];
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
						//echo "connection works!";
			
				$query = $mysqli->query("SELECT username FROM logon WHERE username ='$username'");
				
			
				$numrows = $query->num_rows;
			
				if ($numrows !=0)
				{
					while ($numrows = $query->fetch_assoc())
					{
						$dbusername = $numrows['username'];
					}
					
					if(strcmp($username, $dbusername) == 0)
					{
						echo 0;
					}
			
				}
			else
				{
				
				$register = $mysqli->prepare('
								INSERT INTO logon (sheltername, title, username, password) 
								VALUES (?, ?, ?, ?)');
			$register->bind_param('ssss', $sheltername,  $usertitle, $username, $password);
			
			$register->execute();
			$register->close();
			echo 1;
			//echo("Register Success<a href = shelterlogin.php> log in </a>");
			}
			
			
			
			
			
			
		
	}
	else
	{
		
	}

?>


			