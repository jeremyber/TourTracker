<?php session_start();
	$original = $_POST['originalpwd'];
	$new = $_POST['newpassword'];
	$confirm = $_POST['confirmnewpassword'];
	
	try
	{
		$userid = $_SESSION['userid'];
		$dbconnection = new PDO('mysql:host=localhost; dbname=it354_jdber', 'it354_jdber', '97864fd');
		$querylogin = "SELECT password from tt_login where userid='$userid'";
		foreach($dbconnection->query($querylogin) as $row)
		{
			if($row['password']==sha1($original))
			{
				
				//original password is correct
				if($new===$confirm)
				{
					//new and confirm match, change password
					$updatestatement = "UPDATE tt_login SET password=? WHERE userid=?";
					$q=$dbconnection->prepare($updatestatement);
					$q->execute(array(sha1($confirm), $userid));
					
					echo "true";
					break;
				}
				else
				{
					echo "New passwords do not match.";
					break;
				}
			
			}
			else
			{
				echo "Original password is not correct.";
			}

			
			break;
			
		}
		$dbconnection = null;
	}
	catch(Exception $e)
	{
		echo ($e->getMessage());
	}
	
?>