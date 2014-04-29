<?php 
	session_start();
	$date = $_GET['date'];
	$song = $_GET['song'];
	$file = file_get_contents('https://api.phish.net/api.js?api=2.0&method=pnet.shows.setlists.get&format=json&apikey=E11590CE106F584601C1&showdate='.$date.'&callback=');
	$json = json_decode($file);
	$setlist = null;
	if($json->success!='0')
	{
		foreach($json as $show)
		{
			$setlist = $show->setlistdata;
			$venue = $show->venue;
			$city = $show->city;
			$state = $show->state;
			$date = $show->showdate;
			$nicedate = $show->nicedate;
			$notes = $show->setlistnotes;
		}
		$phishin = file_get_contents('http://phish.in/api/v1/shows/'.$date);
		$json_songs = json_decode($phishin);

	
	
		
	
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
    <title><?=$date?> Phish | Tour Tracker</title>
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="js/tt.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/starter-template.css" rel="stylesheet">
    <script src="audiojs/audiojs/audio.min.js"></script>
	    <script>
		
      $(function() { 
        // Setup the player to autoplay the next track
        var a = audiojs.createAll({
          trackEnded: function() {
            var next = $('ol li.playing').next();
            if (!next.length) next = $('ol li').first();
            next.addClass('playing').siblings().removeClass('playing');
            audio.load($('a', next).attr('data-src'));
            audio.play();
          }
        });
        
        // Load in the first track
        var audio = a[0];
            first = $('ol a').attr('data-src');
        $('ol li').first().addClass('playing');
        audio.load(first);

        // Load in a track on click
        $('ol li').click(function(e) { 
          e.preventDefault();
          $(this).addClass('playing').siblings().removeClass('playing');
          audio.load($('a', this).attr('data-src'));
          audio.play();
		  var href = $(this).children().attr('href');
		  history.pushState(null, null, href);
        });
        // Keyboard shortcuts
        $(document).keydown(function(e) {
          var unicode = e.charCode ? e.charCode : e.keyCode;
             // right arrow 
          if (unicode == 39) {
            var next = $('li.playing').next();
            if (!next.length) next = $('ol li').first();
            next.click();
            // back arrow
          } else if (unicode == 37) {
            var prev = $('li.playing').prev();
            if (!prev.length) prev = $('ol li').last();
            prev.click();
            // spacebar
          } else if (unicode == 32) {
            audio.playPause();
          }
        })
		
		if("<?=$song?>"!='')
		{
			$('#<?=$song?>').click();
		}
      });
    </script> 
	<style> 
	.setlist {
	display: block;
	margin-right: 96px;
	}
	
	.playing
	{
		background-color:lightblue;
	}
	
	</style>
 
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
   include ("modals.php"); ?>  
	
   <div class="starter-template">
  <form action="phish.php">
    <input type="submit" value="Go Back">
</form>
	<h1>
		<?= $nicedate;?><br/>
		<?= $city;?>, <?= $state;?><br/>
		<?= $venue;?>
	</h1> 
	<br/>
	</div>
   <div class="container">
   <?php
   
   if((count($json_songs->data->tracks))>0) 
	{	
		?>
	
	<div class="setlist pull-left">
      <audio preload></audio>
      <ol>
	  <?php 
	
	  foreach($json_songs->data->tracks as $songs)
	  { 
		echo "<li><a href='phishshow.php?date=".$date."&song=".$songs->id."' id='".$songs->id."' data-src='".$songs->mp3."'>".$songs->title."</a></li>";
	  }
	 }
	 else
	 {
		echo "<b>No audio exists for these songs. Sorry.</b>";
	}?>
      </ol>
	 </div
    </div>
   <div class="container">
	<?php 
		if($setlist!=null)
		{
			echo $setlist;
		}
		else
		{
			echo "<h2>No setlist available, sorry.</h2>";
		}
	}
	else
	{
		echo "<h2>No setlist available, sorry.</h2>";
	}
	?><br/>
	<b>Additional Notes:</b><br/>
	<?= $notes;?>
	<br/><br/><br/><br/><br/>
   </div>
	 
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
