<?php
	session_start();
	error_reporting(E_ALL);
	if(isset($_GET['bandid']))
	{
	
			function addToTour($showid)
			{
				echo $showid;
				
			}
			
			
					ini_set('display_errors', 1);
						try {
								 $dbconnection = new PDO('mysql:host=localhost; dbname=it354_jdber', 'it354_jdber', '97864fd');
								 $result = $dbconnection->query("Select * from tt_band_event join tt_show 
																 ON tt_band_event.showid = tt_show.showid 
																 WHERE tt_band_event.bandid='".$_GET['bandid']."'");
								$band_name = $dbconnection->query("SELECT band_name, members from tt_band where bandid='".$_GET['bandid']."'");
								$name = $band_name->fetch();
								
								
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
    <title>Bands | Tour Tracker</title>
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="js/tt.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/starter-template.css" rel="stylesheet">
	
	<!-- Dynatable -->
	<link href="dynatable/jquery.dynatable.css">
	<script src="dynatable/jquery.dynatable.js"></script>
	<script>
	$(document).ready(function()
	{
		$('.add_to_tour').click(function()
		{	
			showid = $(this).parent().attr('id');
			$.get("php/addtotour.php", {id:showid},
				function(data)
				{
					alert(data);
					location.reload();
				});
		
		});
		
		$('.remove_from_tour').click(function()
		{	
			showid = $(this).parent().attr('id');
		
			$.get("php/removefromtour.php", {id:showid},
				function(data)
				{
					alert(data);
					location.reload();
				});
		});
	});
	</script> 

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
 <body>
	
   <?php include ("navbar.php");
		 include ("modals.php");?>
	
	<div class="starter-template">
		<h1><?=$name['band_name'];?></h1>
		<p><?=$name['members'];?></p>
	</div>
	<!-- Tour table -->
	<div class="container">
	<table id="bands-table" class="table table-bordered">
		<thead>
		<tr>
		<th>Headliner</th>
		<th>Other Acts</th>
		<th>Date</th>
		<th>Location</th>
		<th>Venue</th>
		<th>Description</th>
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
			
				if(isset($_SESSION['userid']))
								$user_tour = $dbconnection->query("Select * from tt_user_tour 
													where userid='".$_SESSION['userid']."'");
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
				<td><?=$tour['event_description'];?></td>
				<td><?=$start_time->format('g:i a');?></td>
				<td><?=$end_time->format('g:i a');?></td>
				<?php if(isset($_SESSION['userid'])) {
						
						//only fetching once, need to compare for as many rows as there are
						while($row = $user_tour->fetch())
						{
							if($row['showid']==$tour['showid'])
							{	
								$inMyTour = true;
								break;
							}
							
						}
				if(!$inMyTour)
				{
				?>
					<td id="<?=$showid?>">
						<button type="button" class="btn btn-info add_to_tour">
						  <span class="glyphicon glyphicon-plus"></span> Add to Tour
						</button>
					</td>	
				<?php 
				}
				else
				{?>
					<td id="<?=$showid?>">
						<button type="button" class="btn btn-danger remove_from_tour">
						  <span class="glyphicon glyphicon-remove"></span> Remove from Tour
						</button>
					</td>	
			<?php }
			}?>
						
				</tr>
		<?php
			}
		?>
	</table>
</div>
	
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

	<?php
		}
		catch(PDOException $e)
		{
			print "Error!: ". $e->getMessage() . "<br/>";
			die();
		}
	}
	else
	{
		Session_destroy();
		include('error.php');
	}
	?>
