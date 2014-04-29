<?php


$username = $_POST['username'];


 try {
 
		
		 $dbconnection = mysqli_connect("localhost", "it354_jdber", "97864fd", "it354_jdber");
		  if (!empty($username)) {
            $username_query = mysqli_query($dbconnection, "SELECT COUNT(`username`) FROM `tt_login` WHERE `username`='$username'"); 
			
			
			$username_result = mysqli_fetch_row($username_query);
			if($username_result[0]=='0')
			{
				echo "";
			}
			else
			{
				echo "exists"; 	//email already exists
			}
			
		} 
			$dbconnection = null;
	}
	catch(PDOException $e)
	{
		
		echo "Error!: ". $e->getMessage() . "<br/>";
		die();
	}

	
?>


