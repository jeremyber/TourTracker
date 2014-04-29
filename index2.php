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
    <title>Home | Tour Tracker</title>
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="js/tt.js"></script>
	<script>
			function cycleImages(){
			  var $active = $('#cycler .active');
			  var $next = ($active.next().length > 0) ? $active.next() : $('#cycler img:first');
			  $next.css('z-index',1);//move the next image up the pile
			  $active.fadeOut(1500,function(){//fade out the top image
			  $active.css('z-index',0).show().removeClass('active');//reset the z-index and unhide the image
				  $next.css('z-index',2).addClass('active');//make the next image the top one
			  });
			}

		$(document).ready(function(){
		// run every 7s
		setInterval('cycleImages()', 5000);
		})
		
		
		function checkusername()
		{
			var username = $('#registerusername').val();
			if(username!='')
			{
				$.post('php/checkusername.php', {username: username}, 
				function(data){
					console.log(data);
					if((data.trim()).localeCompare("exists")==0)
					{
						$('#registererror').hide().html("<p>Username already exists.</p>").fadeIn('slow');
						$('#registersubmit').fadeOut('slow');
					}
					else
					{
						$('#registersubmit').fadeIn();
						$('#registererror').hide().html("").fadeIn('slow');
					}
						
				});
			}
			
		
		}
	</script>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/starter-template.css" rel="stylesheet">


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
	<div class="container">
		<div id="this-carousel-id" class="carousel slide"><!-- class of slide for animation -->
		  <div class="carousel-inner">
			<div class="item active"><!-- class of active since it's the first item -->
			  <img src="./img/concert1.jpg" alt=""/>
			  <div class="carousel-caption">
				<p></p>
			  </div>
			</div>
			<div class="item">
			  <img src="./img/homeimage-blue.jpg" alt=""/>
			  <div class="carousel-caption">
				<p></p>
			  </div>
			</div>
			<div class="item">
			  <img src="./img/concert3.jpg" alt=""/>
			  <div class="carousel-caption">
				<p></p>
			  </div>
			</div>
		  </div><!-- /.carousel-inner -->
		  <!--  Next and Previous controls below
				href values must reference the id for this carousel -->
			<a class="carousel-control left" href="#this-carousel-id" data-slide="prev"><span class="glyphicon glyphicon-circle-arrow-left"></span></a>
			<a class="carousel-control right" href="#this-carousel-id" data-slide="next"><span class="glyphicon glyphicon-circle-arrow-right"></span></a>
		</div><!-- /.carousel -->
		</div>
	</div>
	<div class="container">
		<center><h1><a href="phish.php">Check out Phish dates here!</a></h1></center>
	</div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
