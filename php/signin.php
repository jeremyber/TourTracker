<?php
session_start();
$username = $_POST['username'];
$password = $_POST['password'];
$isChecked = $_POST['isChecked'];

if($username !='' && $password!='')
{
	 $dbconnection = new PDO('mysql:host=localhost; dbname=it354_jdber', 'it354_jdber', '97864fd');
	 //Insert User Data
	$querylogin = "SELECT tt_login.password, tt_login.userid, tt_login.username, tt_user.firstname
					FROM tt_login join tt_user on tt_login.userid = tt_user.userid
					WHERE tt_login.username = '$username'";
	foreach($dbconnection->query($querylogin) as $row)
	{
		if($row['password']==sha1($password))
		{
			
		  $_SESSION['userid'] = $row['userid'];
          $_SESSION['username'] = $row['username'];
		  $_SESSION['firstname'] = $row['firstname'];
		  if(isChecked=="true")
		  {
			  setcookie('username', $row['username'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
			  setcookie('user_id', $row['user_id'], time() + (60 * 60 * 24 * 30));    // expires in 30 days
		  }
		  echo "true";
		  break;
		}
	}
	$dbconnection = null;
}
else
{
	echo "empty";
}


?>