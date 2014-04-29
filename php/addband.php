<?php
	$bandName = $_POST['bandName'];
	$year = $_POST['year'];
	$members = $_POST['members'];
	$wiki = $_POST['wiki'];
	$genre = $_POST['genre'];
	$onTour = $_POST['onTour'];
	
	try {
		 $dbconnection = new PDO('mysql:host=localhost; dbname=it354_jdber', 'it354_jdber', '97864fd');
		 
		 //Insert User Data
		 $insert_band = "INSERT into tt_band (band_name, year_formed, members, wiki, genre, on_tour) 
								VALUES(:band_name, :year_formed, :members, :wiki, :genre, :on_tour)";
		 $q=$dbconnection->prepare($insert_band);
		 $q->execute(array(":band_name"=>$bandName, ":year_formed"=>$year, ":members"=>$members, ":wiki"=>$wiki, 
		 ":genre"=>$genre, ":on_tour"=>$onTour));
		 
		//echo json_encode($q->errorInfo());
		
		echo("Successfully added ".$bandName." to the band List!");
		
		$dbconnection = null;
	}  
	catch(PDOException $e)
	{
		
		echo "Error!: ". $e->getMessage() . "<br/>";
		die();
	}

?>