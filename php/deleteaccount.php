<?php session_start();
	
	
	try
	{
		$userid = $_SESSION['userid'];
		$dbconnection = new PDO('mysql:host=localhost; dbname=it354_jdber', 'it354_jdber', '97864fd');
		$deleteuser = "DELETE FROM tt_user where userid= :userid";
		$stmt = $dbconnection->prepare($deleteuser);
		$stmt->bindParam(':userid', $userid);
		$stmt->execute();
		$dbconnection = null;
		session_destroy();
		
	}
	catch(Exception $e)
	{
		echo ($e->getMessage());
	}
	
?>