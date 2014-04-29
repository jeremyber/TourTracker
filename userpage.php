<?php 
	session_start();
					error_reporting(E_ALL);
					ini_set('display_errors', 1);
					if(isset($_SESSION['userid']))
					{
						try {
								 $dbconnection = new PDO('mysql:host=localhost; dbname=it354_jdber', 'it354_jdber', '97864fd');
								 $result = $dbconnection->query("SELECT * FROM tt_user join tt_login ON tt_user.userid=tt_login.userid WHERE tt_user.userid='".$_SESSION['userid']."'");
								 $firstname = null;
								 $lastname = null;
								 $email = null;
								 $phone = null;
								 $username = null;
								 $date_joined = null;
								 $user = $result->fetch();
								 
								 if($user)
								 {
									$firstname = $user['firstname'];
									$lastname = $user['lastname'];
									$email = $user['email'];
									$phone = $user['phone'];
									$username = $user['username'];
									$date_joined = $user['date_joined'];
								}
								else
								 {
									?><h1>Could not find client data, sorry.</h1><?php
								 }
							
								$dbh = null;
							}
							catch(PDOException $e)
							{
									print "Error!: ". $e->getMessage() . "<br/>";
									die();
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
	$(document).ready(function(){
		$('#deleteacct').click(function()	
		{
					$("*").css("background-color", "red");
					if(confirm("Do you really want to delete your account, <?=$_SESSION['firstname'];?>?"))
					{
						$.ajax({
							url:"php/deleteaccount.php"
							})
						.done(function(data)	
						{
							alert("account deleted. goodbye.");
							$("body").fadeOut(1000, function(){
								window.location = "index.php";
							});
							
						});
					}
					else
					{
						$("*").removeAttr('style');
					}
						
		});
		$('#update').click(function()	
		{
					var firstname = $('#firstname').val();
					var lastname = $('#lastname').val();
					var email = $('#email').val();
					var phone = $('#phone').val();
					$("*").css("background-color", "green");
					if(confirm("Do you really want to update your account, <?=$_SESSION['firstname'];?>?"))
					{
						$.ajax({
							type:'POST',
							url:"php/updateaccount.php",
							data: {'firstname':firstname,
									'lastname':lastname,
									'email':email,
									'phone':phone},
							success: function(data)
							{
								if(data=="true")
								{
									console.log(data);
									$("*").removeAttr('style');
									alert("Profile successfully updated!");
									location.reload();
								}
								else
								{
									$("*").removeAttr('style');
									alert(data);
									
								}
							},
							error: function(data)
							{
								alert("Oops. Something went wrong. We will fix it shortly.");
							}
						});
					}
					else
					{
						$("*").removeAttr('style');
					}
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
	
   <?php 
   include ("navbar.php");
   include ("modals.php");
	   if(isset($_SESSION['userid']))
	   {
    ?>
	<div class="starter-template">
		<h1><?php echo $firstname; ?>'s profile information</h1>
		<p>Registered on <?php echo $date_joined; ?></p>
	</div>
	<div class="container">
			<h3>Edit your profile information here</h3>
			<!-- EDIT PROJECT FORM -->
				<form role="form">
				<p id="editerror" class="text-danger"></p>
				<p id="editsuccess" class="text-success"></p>
				<div class="row">
				 <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
					<label for="code">Username (cannot change)</label>
					  <input id="username" value="<?= $username; ?>" type="text" class="form-control focusedInput" placeholder="Enter Username..." disabled />
				  </div>
				</div>
				<div class="row">
				  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
					<label for="code">First Name</label>
					  <input id="firstname" value="<?= $firstname; ?>" type="text" class="form-control focusedInput" placeholder="Enter First Name..." />
				  </div>
				</div>
				<div class="row">
				  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
					<label for="code">Last Name</label>
					  <input id="lastname" value="<?= $lastname; ?>"  type="text" class="form-control focusedInput" placeholder="Enter Last Name..." />
				  </div>
				</div>
				<div class="row">
				  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
					<label for="code">Email Address</label>
					  <input id="email" value="<?= $email; ?>"  type="text" class="form-control focusedInput" placeholder="Enter Email Address" />
				  </div> 
				</div>
				<label for="code">Phone Number</label>
				<div class="row">
				  <div class="form-group col-lg-5 col-md-7 col-sm-9 col-xs-12">
					  <input id="phone" value="<?= $phone; ?>"  type="text" maxlength=12 class="form-control focusedInput" placeholder="###-###-####" />
				  </div>
				</div>
				<div class="clearfix">
					<div class="row">
					 <div class="form-group col-xs-12 col-lg-12 pull-left">
					  <button id="changepwd" type="button" class="btn btn-info" onclick="window.location.href='changepassword.php'">Change Password</button>
					  <button id="deleteacct" type="button" class="btn btn-danger">Delete Account</button>
					</div>
				  </div>
				 </div>
				<div class="row">
					<div class="form-group col-xs-3 col-lg-1">
						<button id="update" type="button" class="btn btn-success">Update</button>
					</div>
				</div>
			</form>
	  </div>
		<?php 
						}
						else
						{
							 include("error.php");
							
						}
		?>
	
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
	<?php
		}
		else
		{
			include ("error.php");
		
		}
	?>
