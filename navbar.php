 <style>
 #name
 {
	margin-right:35px;
 }
 </style>
 <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/jdber/TourTracker/">Tour Tracker</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="index2.php">Home</a></li>
            <li><a href="bands.php">Bands</a></li>
            <li><a href="shows.php">Shows</a></li>
          </ul>
		  <ul class="nav navbar-nav navbar-right">
			<?php if(isset($_SESSION['firstname'])) {
			?>
				<li class="dropdown">
					 <a href="#" id="name" class="dropdown-toggle" data-toggle="dropdown"><?=$_SESSION['firstname'];?> <b class="caret"></b></a>
					     <ul class="dropdown-menu">
						  <li><a style="margin-right: 38px;" href="myshows.php" role="button" rel="tooltip">My Shows</a></li>
						  <li><a style="margin-right: 38px;" href="userpage.php" role="button" rel="tooltip">Edit Profile</a></li>
						  <li><a id="signout" style="margin-right: 38px;" href="php/signout.php" role="button" rel="tooltip">Sign Out</a></li>
						  
						</ul>
				</li>
			<?php }else{ ?>
			
			<li><a style="margin-right: 38px;" href="#signIn" role="button" data-toggle="modal" rel="tooltip">Sign In</a></li>
			<?php } ?>
		</ul>

      </div>
    </div> <!--End Nav Bar -->