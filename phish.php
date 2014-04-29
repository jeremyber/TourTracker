<?php 
	session_start();
	
	
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
    <title>Phish | Tour Tracker</title>
	
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
	tr:hover td {
	  background-color: lightgreen !important; color: #000 !important;
	} 
	.showdate:hover {
		background-color: lightblue !important; color: #000 !important;
	}
</style>
	
	<script>
	
	$(document).ready(function()
	{
		
		
		$('td').click(function()
		{
			var shows_id = "#shows_"+this.id;
			if($(shows_id).is(':visible'))
			{
				$(shows_id).toggle();
			} 
			else 
			{
				if($(shows_id).is(':empty'))
				{
					$.get("php/phishtour.php", {year:this.id},  
					function(data)
					{ 
						
							$(shows_id).append(data);
							$(shows_id).toggle();
							$('.showdate').click(function()
							{
								setlist_id = this;
								$.get("php/phishshow.php", {date:this.id},
								function(setlist)
								{
									//put setlist in a modal;
								
								});
							});
					
					});
					
				}
				else
				{
					$(shows_id).toggle();
				}
			}
			
		});
	
	 
	});
	</script>
  </head>
 <body>
	
   <?php 
   include ("navbar.php");
   include ("modals.php"); ?>   
   <div class="starter-template">
	<h1>Phish dates!</h1> 
   </div>
   <div class="container">
   <?php
   $year = 1983; //phish first year
   echo '<table class="table table-striped">';
   while($year<=date('Y'))
   {
	echo '<tr>';
	echo '<td id='.$year.'>'.$year.'</td>';
	echo '</tr>';
	echo '<tr id="shows_'.$year.'" style="display:none;"></tr>';
	$year++;
    
   }
   echo '</ul>';?>
   </div>
   </div>
	 
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="js/bootstrap.js"></script>
  </body>
</html>
