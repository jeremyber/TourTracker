<?php 
	session_start();

	
		error_reporting(E_ALL);
					ini_set('display_errors', 1);
					if(isset($_SESSION['username']))
					{
						
						
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
	$(document).ready(function(){
		var userid = '<?php echo $_SESSION['userid']; ?>';
		username = '<?php echo $_SESSION['username']; ?>';
		$('#changepwdsubmit').click(function()	
		{
			var originalpwd = $('#ogpassword').val();
			var newpassword = $('#newpassword').val();
			var confirmnewpassword = $('#confirmnewpassword').val();
			
			if(originalpwd.length<1)
			{
				alert("Please enter your orignal password.");
				return false;
	
			}
			if(newpassword.length<1)
			{
				alert("Please enter your new password.");
				return false;
			}
			if(newpassword.length<3)
			{
				alert("Password must be at least 3 characters long.");
				return false;
			}
			if(confirmnewpassword.length<1)
			{
				alert("Please confirm your new password.");
				return false;
			}
			$.post("php/changepassword.php", {originalpwd:originalpwd, newpassword:newpassword, confirmnewpassword:confirmnewpassword},
				 function(data)
				{
					if(data=="true")
					{
						alert("Password has been successfully changed!");
						
					} 
					else
					{
						alert(data);
						
						return false;
					}
				});

		});
		});
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
   include ("modals.php"); ?>
   <div class="starter-template">
	<h1>Change your password</h1>
	</div>
	<div class="container">
		<form role="form">
			<p id="signinerror" class="text-danger"></p>
			<p id="signinsuccess" class="text-success"></p>
			<div class="row">
			  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
				<label for="code">Username</label>
				  <input id="username" type="text" class="form-control" value="<?= $_SESSION['username']; ?>"  placeholder="Enter Username..." disabled />
			  </div>
			</div>

				<div class="row">
				  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
					<label for="code">Original Password</label>
					  <input id="ogpassword" type="password" class="form-control input-normal" placeholder="Enter Original Password"/>
				  </div>
				</div>
				<div class="row">
				  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
					<label for="code">New Password</label>
					  <input id="newpassword" type="password" class="form-control input-normal" placeholder="Enter New Password"/>
				  </div>
				</div>
				<div class="row">
				  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
					<label for="code">Confirm New Password</label>
					  <input id="confirmnewpassword" type="password" class="form-control input-normal" placeholder="Enter New Password"/>
				  </div>
				</div>
			<div class="row">
		  <div class="form-group col-xs-3 col-lg-1">
		  <button id="changepwdsubmit" type="button" class="btn btn-default">Submit</button>
		  </div>
		</div>
	</div>
		<?php 
						}
						else
						{
							 include("error.php");
							
						}
		?>
		    <script src="js/bootstrap.min.js"></script>
</body>
