<?php
	$post_id = $_GET['id'];
	
	/*
session_start();
if (!isset($_SESSION['loggedin'])){
	header('Location: login.html');
	exit();
}
*/

//$id = $_SESSION['id'];
$id = "host_id";
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$db = "imeeting";
						 
	$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
	
   if(isset($_POST['submit']))
   {
	 if ($_POST['submit']==='Accept'){
		$query = "UPDATE `booking` SET `status`='Accepted' WHERE host_id=$id and place_id=$post_id";
		mysqli_query($conn, $query);
	 }else{
		$query = "UPDATE `booking` SET `status`='Declined' WHERE host_id=$id and place_id=$post_id";
		mysqli_query($conn, $query); 
	 }
	 header ('Location: host_book.php');
	 
   }
?>