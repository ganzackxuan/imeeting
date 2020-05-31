<?php
session_start();
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'imeeting';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()){
	die('Failed to connect to MYSQL: ' . mysqli_connect_error());
}
if (!isset($_POST['username'], $_POST['password'])){
	die('Please fill both the username and password field!');
}
if ($stmt = $con->prepare('SELECT user_id, full_name, password, type, city, state, age, countrycode, phonenumber, f_name, l_name, email,image FROM user WHERE username = ?')){
	//Bind parameter (s = string, i = int, b = blob, etc),username is string so "s"
	$stmt->bind_param('s',$_POST['username']);
	$stmt->execute();
	//Store the result so we can check if the account exists in the database.
	$stmt->store_result();
}
if ($stmt->num_rows > 0){
	$stmt->bind_result($id, $full_name, $password, $type, $city, $state, $age, $countrycode, $phonenumber, $f_name, $l_name, $email,$image);
	$stmt->fetch();
	//acc exists, now verify the password
	if($_POST['password'] === $password) {
		//Verrification success, user login
		//Create session so we know the user is logged in
		session_regenerate_id();
		$full_name = $f_name.' '.$l_name;
		$_SESSION['loggedin']= TRUE;
		$_SESSION['full_name'] = $full_name;
		$_SESSION['id'] = $id;
		$_SESSION['type'] = $type;
		$_SESSION['city'] = $city;
		$_SESSION['state'] = $state;
		$_SESSION['image'] = $image;
		if ($_SESSION['type'] === 1){
			header ('Location: host_home.php');
		}else{
			header ('Location: rent_home.php');
		}
	}else{
		echo 'Incorrect password';
	}
}else{
	echo 'Username not found';
}
$stmt->close();
?>