<?php


$firstname = $_POST['phpfirstname'];
$lastname = $_POST['phplastname'];
$username = $_POST['phpusername'];
$password = $_POST['phppassword'];
$email = $_POST['phpemail'];
$phone = $_POST['phpphone'];
$current_date = date('Y-m-d');


 try {
 
		
		 $dbconnection = new PDO('mysql:host=localhost; dbname=it354_jdber', 'it354_jdber', '97864fd');
		 
		 //Insert User Data
		 $insert_user = "INSERT into tt_user (firstname, lastname, email, phone, date_joined) 
								VALUES(:firstname, :lastname, :email, :phone, :date_joined)";
		 $q=$dbconnection->prepare($insert_user);
		 $q->execute(array(":firstname"=>$firstname, ":lastname"=>$lastname, ":email"=>$email, ":phone"=>$phone, 
		 ":date_joined"=>$current_date));
		 
		// echo json_encode($q->errorInfo());
		 
		 //Insert Login Data
		 $userid = $dbconnection->lastInsertId();
		 $insert_login = "Insert into tt_login (userid, username, password) 
										VALUES(:userid, :username, :password)";
										
		//Using SHA1 to encode password								
		$q=$dbconnection->prepare($insert_login);
		$q->execute(array(":userid"=>$userid, ":username"=>$username, ":password"=>sha1($password)));
		 
		$errors = $q->errorInfo();
		
		$dbconnection = null;
	}  
	catch(PDOException $e)
	{
		
		echo "Error!: ". $e->getMessage() . "<br/>";
		die();
	}

	
?>