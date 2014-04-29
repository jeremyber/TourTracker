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
				<h1>You are now signed out.<br> You may have reached this page in <strong><i>error</i></strong>.</h1>
				<p>In any case, <a href="#signIn" role="button" data-toggle="modal" rel="tooltip">sign in</a>! You'll enjoy the site a lot more.</p>
			</div>
	</div>

				

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
