<?php
	$bandName = $_POST['bandName'];
	$bandid = $_POST['bandid'];
	$theDate = $_POST['theDate'];
	$startTime = $_POST['startTime'];
	$endTime = $_POST['endTime'];
	$location = $_POST['location'];
	$venue = $_POST['venue'];
	$headline = $_POST['headline'];
	$description = $_POST['description'];
	
	try {
		 $dbconnection = new PDO('mysql:host=localhost; dbname=it354_jdber', 'it354_jdber', '97864fd');
		 
		 //Insert User Data
		 $insert_show = "INSERT into tt_show (showdate, location, venue, start_time, end_time) 
								VALUES(:showdate, :location, :venue, :start_time, :end_time)";
		 $q=$dbconnection->prepare($insert_show);
		 $q->execute(array(":showdate"=>$theDate, ":location"=>$location, ":venue"=>$venue, ":start_time"=>$startTime, 
		 ":end_time"=>$endTime));
		 
		// echo json_encode($q->errorInfo());
		 
		 //Insert Login Data
		 $showid = $dbconnection->lastInsertId();
		 $insert_event = "Insert into tt_band_event (showid, bandid, headliner, event_description) 
										VALUES(:showid, :bandid, :headliner, :event_description)";
										
		//Using SHA1 to encode password								
		$q=$dbconnection->prepare($insert_event);
		$q->execute(array(":showid"=>$showid, ":bandid"=>$bandid, ":headliner"=>$headline, ":event_description"=>$description));
		 
		$errors = $q->errorInfo();
		
		echo("Successfully added your ".$bandName." show!");
		
		$dbconnection = null;
	}  
	catch(PDOException $e)
	{
		
		echo "Error!: ". $e->getMessage() . "<br/>";
		die();
	}

?>