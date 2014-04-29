<?php 
	session_start();
	ini_set('display_errors', 1);
	try {
		 $dbconnection = new PDO('mysql:host=localhost; dbname=it354_jdber', 'it354_jdber', '97864fd');
		 $result = $dbconnection->query("Select DISTINCT tt_show.showid, tt_show.showdate, tt_show.location, tt_show.venue, tt_show.start_time, tt_show.end_time, tt_band_event.headliner
		 from tt_band_event join tt_show ON tt_band_event.showid = tt_show.showid ORDER BY tt_show.showdate");
		$band_name = $dbconnection->query("SELECT band_name, members from tt_band where bandid='".$_GET['bandid']."'");
		$name = $band_name->fetch();
		
		//query band names
		$band_list = $dbconnection->query("Select bandid, band_name from tt_band");
	
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
	
 
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
  </head>
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
		
		//validate add show information
		$('#showsubmit').click(function()	{
			var bandName = $('#bandName option:selected').text();
			var bandid = $('#bandName option:selected').val();
			var theDate = $('#dateid').val();
			var startTime = $('#startTime').val()+":00";
			var endTime = $('#endTime').val()+":00";
			var location = $('#location').val();
			var venue = $('#venue').val();
			var headline = $('#headline').val();
			var description = $('#description').val();
			
			$.post('php/addshow.php', {bandName: bandName, bandid: bandid, theDate: theDate, startTime: startTime, endTime: endTime, 
				location: location, venue: venue, headline: headline, description: description}, 
			function(data){
				alert(data);
			location.reload();
			});
		});
		
		$('#bandName').change(function(){
			if ($(this).val() === 'Other'){
				$('#addshow').modal('hide');
				$('#addband').modal('show');
				return false;
			}
		});
	});
	</script> 
 <body>
	
   <?php 
   include ("navbar.php");
   include ("modals.php"); ?>   
   <div class="starter-template">
	<h1>All Shows</h1> 
   </div>
   <div class="container">
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addshow">Add Show</button>
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
					<td>
						<button  id="<?=$showid?>" type="button" class="btn btn-info add_to_tour">
						  <span class="glyphicon glyphicon-plus"></span> Add to Tour
						</button>
					</td>	
				<?php 
				}
				else
				{?>
					<td>
						<button  id="<?=$showid?>" type="button" class="btn btn-danger remove_from_tour">
						  <span class="glyphicon glyphicon-remove"></span> Remove from Tour
						</button>
					</td>	
			<?php }
			}?>
						
				</tr>
		<?php
			}
			}
			catch(PDOException $e)
		{
			print "Error!: ". $e->getMessage() . "<br/>";
			die();
		}
		?>
	</table>
</div>
<div class="modal fade" id="addshow" tabindex="-1" role="dialog" aria-labelledby="showLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="registerLabel">Add A Show</h4>
      </div>
      <div class="modal-body">
		<div class="container">
		<form role="form">
		<div id="errors">
		<p id="showerror" class="text-danger"></p>
		<p id="showsuccess" class="text-success"></p>
		</div>
		<div class="row">
		  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
			<label for="code">Band Name</label>
			  <select id="bandName">
				<?php
					while($band = $band_list->fetch(PDO::FETCH_ASSOC))
					{
						?>
						<option value="<?=$band['bandid'];?>"><?=$band['band_name'];?></option>
						<?
					}
				?>
				<option value="Other">Other Band...</option>
			  </select>
		  </div>
		</div>

		
			<div class="row">
			  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
				<label for="code">Date</label>
				  <input id="dateid" type="date" class="form-control input-normal" placeholder="Enter Date..."/>
			  </div>
			</div>
			
			<div class="row">
			  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
				<label for="code">Start Time</label>
				  <input id="startTime" type="time" class="form-control input-normal" placeholder="Enter Start Time..."/>
			  </div>
			</div>
			
			<div class="row">
			  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
				<label for="code">End Time</label>
				  <input id="endTime" type="time" class="form-control input-normal" placeholder="Enter End Time..."/>
			  </div>
			</div>
			
			<div class="row">
			  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
				<label for="code">Location</label>
				  <input id="location" type="text" class="form-control input-normal" placeholder="Enter City, State..."/>
			  </div>
			</div>
			
			<div class="row">
			  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
				<label for="code">Venue</label>
				  <input id="venue" type="text" class="form-control input-normal" placeholder="Enter Venue..."/>
			  </div>
			</div>
			
			<div class="row">
			  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
				<label for="code">Headliner</label>
				  <input id="headline" type="text" class="form-control input-normal" placeholder="Enter Headline..."/>
			  </div>
			</div>
			
			<div class="row">
			  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
				<label for="code">Event Description</label><br/>
				  <textarea id="description" rows="3" placeholder="Enter Event Description..."></textarea>
			  </div>
			</div>
		</div>
		<div class="row">
		  <div class="form-group col-xs-3 col-lg-1">
		  <button id="showsubmit" type="button" class="btn btn-default">Submit</button>
		  </div>
		</div>
	</form>
    </div>
      </div>
    </div>
  </div>
</div>		


<div class="modal fade" id="addband" tabindex="-1" role="dialog" aria-labelledby="bandLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="registerLabel">Add A Band</h4>
      </div>
      <div class="modal-body">
		<div class="container">
		<form role="form">
		<div id="errors">
		<p id="banderror" class="text-danger"></p>
		<p id="bandsuccess" class="text-success"></p>
		</div>
			<div class="row">
			  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
				<label for="code">Band Name</label>
				  <input id="bandName2" type="text" class="form-control input-normal" placeholder="Enter Band Name..."/>
			  </div>
			</div>

			<div class="row">
			  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
				<label for="code">Year Formed</label>
				  <input id="yearFormed" type="text" class="form-control input-normal" placeholder="Enter Year Formed..."/>
			  </div>
			</div>
			
			<div class="row">
			  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
				<label for="code">Members</label>
				  <input id="members" type="text" class="form-control input-normal" placeholder="Member1, Member2, Member3..."/>
			  </div>
			</div>
			
			<div class="row">
			  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
				<label for="code">Wiki Page</label>
				  <input id="wiki" type="text" class="form-control input-normal" placeholder="Enter Wiki Page..."/>
			  </div>
			</div>
			
			<div class="row">
			  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
				<label for="code">Genre</label>
				  <input id="genre" type="text" class="form-control input-normal" placeholder="Enter Genre..."/>
			  </div>
			</div>
			
			<div class="row">
			  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
				<label for="code">On Tour</label> <br/>
				  <input name="tour" value="Yes" type="radio">Yes</input><br/>
				  <input name="tour" value="No" type="radio">No</input>
			  </div>
			</div>
			
		</div>
		<div class="row">
		  <div class="form-group col-xs-3 col-lg-1">
		  <button id="bandsubmit" type="button" class="btn btn-default">Submit</button>
		  </div>
		</div>
	</form>
    </div>
      </div>
    </div>
  </div>
</div>		
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
