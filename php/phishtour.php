<?php
$year = $_GET['year'];


$file =file_get_contents('https://api.phish.net/api.js?api=2.0&method=pnet.shows.query&format=json&apikey=E11590CE106F584601C1&year='.$year.'&callback=');

$json = json_decode($file);
if($json->success!='0')
{	echo "<ul>";
	foreach($json as $show)
	{
			echo "<li><a href='phishshow.php?date=".$show->showdate."' class='showdate' id='".$show->showdate."'>".$show->nicedate.", ".$show->city.", ".$show->state."</a></li>";
	}
	echo "</ul>";
}
else
{
	echo "No shows recorded in this year.";
}

?>       