<?php
session_start();

$showid = $_GET['id'];


try
{
		$userid = $_SESSION['userid'];
		$dbconnection = new PDO('mysql:host=localhost; dbname=it354_jdber', 'it354_jdber', '97864fd');
		$dbconnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$addshow = $dbconnection->prepare("INSERT INTO tt_user_tour (userid, showid) VALUES (:userid, :showid)");
		if(!$addshow)
		{
			print_r($dbconnection->errorInfo());
		
		}
		else
		{
			$addshow->bindParam(':userid', $userid);
			$addshow->bindParam(':showid', $showid);
			$addshow->execute();
			echo "Successfully added show!";
		}
		
		
		
}
catch(Exception $e)
{
		echo ($e->getMessage());
}		
		



?>