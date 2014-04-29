<?php 
	session_start();
	ini_set('display_errors', 1);
	
	if(isset($_SESSION['userid']))
	{
	try {
		 $dbconnection = new PDO('mysql:host=localhost; dbname=it354_jdber', 'it354_jdber', '97864fd');
		 $result = $dbconnection->query("Select DISTINCT tt_show.showid, tt_show.showdate, tt_show.location, tt_show.venue, tt_show.start_time, tt_show.end_time, tt_band_event.headliner
		 from tt_band_event join tt_show ON tt_band_event.showid = tt_show.showid ORDER BY tt_show.showdate");
		 
		 $geocode = $dbconnection->query("Select DISTINCT tt_show.showid, tt_show.showdate, tt_show.location, tt_show.venue, tt_show.start_time, tt_show.end_time, tt_band_event.headliner
		 from tt_band_event join tt_show ON tt_band_event.showid = tt_show.showid ORDER BY tt_show.showdate");
		$band_name = $dbconnection->query("SELECT band_name, members from tt_band where bandid='".$_GET['bandid']."'");
		
		$details = $dbconnection->query("Select DISTINCT tt_show.showid, tt_show.showdate, tt_show.location, tt_show.venue, tt_show.start_time, tt_show.end_time, tt_band_event.headliner
		 from tt_band_event join tt_show ON tt_band_event.showid = tt_show.showid ORDER BY tt_show.showdate");
		 
		 $places = $dbconnection->query("Select DISTINCT tt_show.showid, tt_show.showdate, tt_show.location, tt_show.venue, tt_show.start_time, tt_show.end_time, tt_band_event.headliner
		 from tt_band_event join tt_show ON tt_band_event.showid = tt_show.showid ORDER BY tt_show.showdate");
		
		$API_KEY = 'AIzaSyCloWKLCug4EVrQ3bL5RVsO-v1KMj90Z2I';
		$locations = array();
		while($tour = $geocode->fetch(PDO::FETCH_ASSOC))
		{
			$inMyTour = false;
			if(isset($_SESSION['userid']))
										$user_tour = $dbconnection->query("Select * from tt_user_tour 
															where userid='".$_SESSION['userid']."'");
				if(isset($_SESSION['userid'])) 
				{
						
						//only fetching once, need to compare for as many rows as there are
						while($row = $user_tour->fetch())
						{
							
							if($row['showid']==$tour['showid'])
							{	
								$inMyTour = true;
								break;
							}
							
						}
				}
				if($inMyTour)
				{
					$location = addslashes(urlencode($tour['location']));
					$file_string = 'https://maps.google.com/maps/api/geocode/json?address=' .$location.'&sensor=false&key='.$API_KEY;
					
					$ch = curl_init();
					
					curl_setopt($ch, CURLOPT_URL, $file_string);
					curl_setopt($ch, CURLOPT_HEADER,0); //Change this to a 1 to return headers
					curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					 
					$data = curl_exec($ch);
					$json = json_decode($data);
					 
					//echo "Data: ". $data;
					
					$lat = $json->results[0]->geometry->location->lat;
					$lng = $json->results[0]->geometry->location->lng;
					$place_string = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='.$lat.','.$lng.'&radius=50000&name='.addslashes(urlencode($tour['venue'])).'&sensor=false&key='.$API_KEY;

					$place_curl = curl_init();
					curl_setopt($place_curl, CURLOPT_URL, $place_string);
					curl_setopt($place_curl, CURLOPT_RETURNTRANSFER, TRUE);
					$place_response = curl_exec($place_curl);
					$json_place = json_decode($place_response);
					if($json_place->status!="ZERO_RESULTS")
					{
						$locations[] = $json_place;
					}
					else
					{
						$locations[] = $json;
					}
					
					
					curl_close($ch);
				}
					
					
					
		
			
		}
		

?>	
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<link href='http://fonts.googleapis.com/css?family=Covered+By+Your+Grace' rel='stylesheet' type='text/css'>
    <title><?= $_SESSION['firstname'];?>'s Shows | Tour Tracker</title>
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="js/tt.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/starter-template.css" rel="stylesheet">
	
		<!-- Dynatable -->
	<link href="dynatable/jquery.dynatable.css">
	<script src="dynatable/jquery.dynatable.js"></script>
	
	
 
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
	#map_wrapper {
    height: 400px;
}

#map_canvas {
    width: 100%;
    height: 100%;
}
</style>
  </head>
  <script>
  
  jQuery(function($) {
    // Asynchronously Load the map API 
    var script = document.createElement('script');
    script.src = "http://maps.googleapis.com/maps/api/js?sensor=false&callback=initialize";
    document.body.appendChild(script);
});

function initialize() {
		var rendererOptions = {
	  draggable: true
	};
var directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);;
var directionsService = new google.maps.DirectionsService();

    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };
                    
    // Display a map on the page
    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
	directionsDisplay.setMap(map);
    map.setTilt(45);
     var markers = [
		<?php foreach($locations as $location)
			  {?>

        ['', <?=$location->results[0]->geometry->location->lat?>,<?=$location->results[0]->geometry->location->lng?>],
			
		<?php } ?>
    ];
	
	var infoWindowContent = [
    <?php 

	while($tour = $details->fetch(PDO::FETCH_ASSOC))  
	{
		$inMyTour = false;
		if(isset($_SESSION['userid']))
										$user_tour = $dbconnection->query("Select * from tt_user_tour 
															where userid='".$_SESSION['userid']."'");
				if(isset($_SESSION['userid'])) 
				{
						
						//only fetching once, need to compare for as many rows as there are
						while($row = $user_tour->fetch())
						{
							if($row['showid']==$tour['showid'])
							{	
								$inMyTour = true;
								break;
							}
							
						}
				}
				if($inMyTour)
				{
					$date = new DateTime($tour['showdate']);
	?>
    // Info Window Content
    
        ['<div class="info_content">' +
        '<h3><?=addslashes($tour['headliner'])?></h3>' +
		'<h6><?=addslashes($tour['venue'])?></h3>' +
        '<p><?=addslashes($tour['location'])?></p>' +  '<p><?=$date->format('F j, Y');?></p></div>'],
		<?}
		}?>
    ];
        
    // Display multiple markers on a map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Loop through our array of markers & place each one on the map  
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            title: markers[i][0]
        });
        
        // Allow each marker to have an info window    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));
		
        // Automatically center the map fitting all markers on the screen
        map.fitBounds(bounds);
		
		
    }

}
</script>
  <script>
	$(document).ready(function()
	{
		$('.add_to_tour').click(function()
		{	
			showid = this.id;
			$.get("php/addtotour.php", {id:showid},
				function(data)
				{
					alert(data);
					location.reload();
				});
		
		});
		
		$('.remove_from_tour').click(function()
		{	
			showid = this.id;
		
			$.get("php/removefromtour.php", {id:showid},
				function(data)
				{
					alert(data);
					location.reload();
				});
		});
	
	
});
	
	</script> 
 <body>
	
   <?php 
   include ("navbar.php");
   include ("modals.php"); ?>   
   <div class="starter-template">
	<h1><?=$_SESSION['firstname']?>'s Shows</h1> 
   </div>
   <div class="container">
	<table id="bands-table" class="table table-bordered">
		<thead>
		<tr>
		<th>Headliner</th>
		<th>Other Acts</th>
		<th>Date</th>
		<th>Location</th>
		<th>Venue</th>
		<th>Start Time</th>
		<th>End Time</th>
		<?php if(isset($_SESSION['userid'])) {?>
				<th>Add to Your Tour</th>
		<?php } ?>
		</tr>
		</thead>
		
		<?php
			
			while($tour = $result->fetch(PDO::FETCH_ASSOC))
			{
				$inMyTour = false;
				if(isset($_SESSION['userid']))
										$user_tour = $dbconnection->query("Select * from tt_user_tour 
															where userid='".$_SESSION['userid']."'");
				if(isset($_SESSION['userid'])) 
				{
						
						//only fetching once, need to compare for as many rows as there are
						while($row = $user_tour->fetch())
						{
							if($row['showid']==$tour['showid'])
							{	
								$inMyTour = true;
								break;
							}
							
						}
				}
				if($inMyTour)
				{
						
						$showid = $tour['showid'];
						$inMyTour = false;
						$date = new DateTime($tour['showdate']);
						$start_time = new DateTime($tour['start_time']);
						$end_time = new DateTime($tour['end_time']);
						$other_bands = $dbconnection->query("Select tt_band.band_name from tt_band 
											join tt_band_event on tt_band.bandid=tt_band_event.bandid 
											join tt_show on tt_show.showid=tt_band_event.showid
											where tt_show.showid='".$tour['showid']."'
											AND tt_band.band_name NOT IN('".$tour['headliner']."')");
				?>
						<tr>
						<td><?=$tour['headliner'];?></td>
						<td><?
						if($other_bands->rowCount()>0)
						{
							while($other = $other_bands->fetch(PDO::FETCH_ASSOC))
							{
								echo $other['band_name'].'<br/>';
							}
						}
						else
						{
							echo "None";
						}
						?>
						</td>
						<td><?= $date->format('F j, Y');?></td>
						<td><?=$tour['location'];?></td>
						<td><?=$tour['venue'];?></td>
						<td><?=$start_time->format('g:i a');?></td>
						<td><?=$end_time->format('g:i a');?></td>
						<td>
							<button  id="<?=$showid?>" type="button" class="btn btn-danger remove_from_tour">
								 <span class="glyphicon glyphicon-remove"></span> Remove from Tour
							</button>
						</td>	
								
						</tr>
				<?php
					}
				  }
				  }
				catch(PDOException $e)
				{
					print "Error!: ". $e->getMessage() . "<br/>";
					die();
				}
			
				?>
			</table>
		<div id="map_wrapper">
			<div id="map_canvas" class="mapping"></div>
		</div>
		<br/><br/><br/><br/><br/>
</div>
	 
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

<?php }
	  else
	  {
		include("error.php");
	  }
	  ?>
