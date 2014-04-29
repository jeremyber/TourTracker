<?php
	session_start();
	
	error_reporting(E_ALL);
					ini_set('display_errors', 1);
						try {
								 $dbconnection = new PDO('mysql:host=localhost; dbname=it354_jdber', 'it354_jdber', '97864fd');
								 $result = $dbconnection->query("Select * from tt_band");
								
						
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
 <body>
	
   <?php include ("navbar.php");
		 include ("modals.php");?>
	
	<div class="starter-template">
		<h1>Bands</h1>
	</div>
<div class="container">
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addband">Add a Band</button>
	<table id="bands-table" class="table table-bordered">
		<thead>
		<tr>
		<th>Band</th>
		<th>Members</th>
		<th>Year Formed</th>
		<th>Genre</th>
		<th>On Tour</th>
		</tr>
		</thead>
		
		<?php
			 
			while($band = $result->fetch(PDO::FETCH_ASSOC))
			{
		?>
				<tr>
				<td><a href="<?=$band['wiki'];?>" target="_blank"><?= $band['band_name'];?></a></td>
				<td><?=$band['members'];?></td>
				<td><?=$band['year_formed'];?></td>
				<td><?=$band['genre']?></td>
				<td><?php 
						if($band['on_tour']=="Yes")
						{
							echo "<a href='tour.php?bandid=".$band['bandid']."'>".$band['on_tour']."</a>";
						}
						else
						{
							echo $band['on_tour'];
						}
					?>
				</td>	
				</tr>
		<?php
			}
		?>
	</table>

	<div class="modal fade" id="addband" tabindex="-1" role="dialog" aria-labelledby="bandLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="registerLabel">Add A Band</h4>
      </div>
      <div class="modal-body">
		<div class="container">
		<form id="bands" role="form">
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
</div>
	<!-- Bands table -->
	
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="js/bootstrap.min.js"></script>
	<script>
		$('#bands-table').dynatable();
	</script>
  </body>
</html>
	<?php
		}
		catch(PDOException $e)
		{
			print "Error!: ". $e->getMessage() . "<br/>";
			die();
	}	
	?>
