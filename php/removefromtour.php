<?php
session_start();

$showid = $_GET['id'];


try
{
		$userid = $_SESSION['userid'];
		$dbconnection = new PDO('mysql:host=localhost; dbname=it354_jdber', 'it354_jdber', '97864fd');
		$dbconnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$removeshow = $dbconnection->prepare("DELETE FROM tt_user_tour WHERE userid= :userid AND showid= :showid");
		if(!$removeshow)
		{
			print_r($dbconnection->errorInfo());
		
		}
		else
		{
			$removeshow->bindParam(':userid', $userid);
			$removeshow->bindParam(':showid', $showid);
			$removeshow->execute();
			echo "Successfully removed show from your tour";
		}
		
		
		
}
catch(Exception $e)
{
		echo ($e->getMessage());
}		
		



?>