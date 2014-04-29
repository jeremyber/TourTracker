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
	</script>
	<style>
	#cycler{position:relative; height: 2000px;}
	#cycler img{position:absolute;z-index:0}
	#cycler img.active{z-index:3}
	#background {position:relative; }
	#sub-text{ display:block; }
	.hometext {
		color: white;
		position: absolute;
		z-index: 10;
		padding-left: 384px;
		padding-top: 92px;
	}
	.header-text{font-family: 'Covered By Your Grace', cursive; font-size: 432%;}
	
	</style>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/frontpage.css" rel="stylesheet">


    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

 <body>

	
	
<div class="starter-template">
	<div class="container">
			<a href="index2.php">
				<div id="cycler">
					<img src="img/homeimage-red.jpg" class="active img-responsive img-rounded" alt="Your Tour. Your Life. Your Way. Tour Tracker." ></img>
					<img src="img/homeimage-green.jpg"  class="img-responsive img-rounded" alt="Your Tour. Your Life. Your Way. Tour Tracker."></img>
					<img src="img/homeimage-purple.jpg"  class="img-responsive img-rounded" alt="Your Tour. Your Life. Your Way. Tour Tracker."></img>
					<img src="img/homeimage-orange.jpg"  class="img-responsive img-rounded" alt="Your Tour. Your Life. Your Way. Tour Tracker."></img>
					<img src="img/homeimage-blue.jpg"  class="img-responsive img-rounded" alt="Your Tour. Your Life. Your Way. Tour Tracker."></img>
				</div>
			</a>
	</div>
</div>
	<!-- Modal Sign In-->
<div class="modal fade" id="signIn" tabindex="-1" role="dialog" aria-labelledby="signInLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="signInLabel">Login Form</h4>
      </div>
      <div class="modal-body">
		<div class="container">
		<form role="form">
		<p id="signinerror" class="text-danger"></p>
		<div class="row">
		  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
			<label for="code">Username</label>
			  <input id="signinuser" type="text" class="form-control" placeholder="Enter Email Address..." />
		  </div>
		</div>

			<div class="row">
			  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
				<label for="code">Password</label>
				  <input id="signinpass" type="password" class="form-control input-normal" placeholder="Enter Password"/>
			  </div>
			</div>


		  <div class="checkbox">
			<label>
				<input type="checkbox"> Remember Me
		  </label>
		</div>
		<div class="row">
		  <div class="form-group col-xs-3 col-lg-1">
		  <button id="signinsubmit" type="button" class="btn btn-default">Submit</button>
		  </div>
		</div>
	</form>
    </div>
      </div>
      <div class="modal-footer">
        <p class="pull-left" style="float:left;">Not registered yet? <a id="signup" href="#">Click here</a></p><br><br>
      </div>
    </div>
  </div>
</div>
				

<!-- Modal Register-->
<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="registerLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="registerLabel">Registration Form</h4>
      </div>
      <div class="modal-body">
		<div class="container">
		<form role="form">
		<div id="errors">
		<p id="registererror" class="text-danger"></p>
		<p id="registersuccess" class="text-success"></p>
		</div>
		<div class="row">
		  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
			<label for="code">Username</label>
			  <input id="registeruser" type="text" class="form-control" placeholder="Enter Email Address..." />
		  </div>
		</div>

			<div class="row">
			  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
				<label for="code">Password</label>
				  <input id="registerpass" type="password" class="form-control input-normal" placeholder="Enter Password"/>
			  </div>
			</div>

			<div class="row">
			  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
				<label for="code">Confirm Password</label>
				  <input id="registerconfirm" type="password" class="form-control input-normal" placeholder="Confirm Password"/>
			  </div>
			</div>
			
			<div class="row">
			  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
				<label for="code">Name</label>
				  <input id="registername" type="text" class="form-control input-normal" placeholder="Enter Name"/>
			  </div>
			</div>
			
			<div class="row">
			  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
				<label for="code">Phone Number</label>
				  <input id="registerphone" type="tel" class="form-control input-normal" placeholder="(_ _ _) _ _ _ - _ _ _ _"/>
			  </div>
			</div>

		  <div class="checkbox">
			<label>
				<input type="checkbox"> Remember Me
		  </label>
		</div>
		<div class="row">
		  <div class="form-group col-xs-3 col-lg-1">
		  <button id="registersubmit" type="button" class="btn btn-default">Submit</button>
		  </div>
		</div>
	</form>
    </div>
      </div>
      <div class="modal-footer">
		<p class="pull-left">Already have an account? <a id="preregister" href="#">Click here</a></p>
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
