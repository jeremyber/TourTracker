<?php
session_start();

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$phone = $_POST['phone'];

if(strlen($firstname)<1)
{
	echo "Please enter in your updated first name.";
	return false;
}
if(strlen($lastname)<1)
{
	echo "Please enter in your updated last name.";
	return false;
}
if(strlen($email)<1)
{
	echo "Please enter in an email address.";
	return false;
}

try
{
		$userid = $_SESSION['userid'];
		$dbconnection = new PDO('mysql:host=localhost; dbname=it354_jdber', 'it354_jdber', '97864fd');
		$dbconnection->setAttribute(PDO::ATTR_EMULATE_PREPARES,false); 
		$updateuser = "UPDATE tt_user SET firstname=?, lastname=?,
										  email=?, phone=? WHERE userid=?";
		$q = $dbconnection->prepare($updateuser);
		if(!$q)
		{
			echo($dbconnection->errorInfo());
		}
		$q->execute(array($firstname, $lastname, $email, $phone, $userid));
		$dbconnection = null;
		echo "true";
		$_SESSION['firstname']=$firstname;
		
		
}
catch(Exception $e)
{
		echo ($e->getMessage());
}		
		



?>