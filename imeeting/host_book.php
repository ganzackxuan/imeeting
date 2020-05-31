<?php

session_start();
if (!isset($_SESSION['loggedin'])){
	header('Location: login.html');
	exit();
}


$id = $_SESSION['id'];

	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$db = "imeeting";
						 
	$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
						 
	$sql = "select *, date(date) AS booked from booking where host_id=$id and status = 'Pending'";
	$result = mysqli_query($conn,$sql);
	
?>
<!DOCTYPE html>
<head>
   <title>Meeting Room Reservation</title>
	<link rel="stylesheet" type="text/css" href="css/header.css">
     <link href="https://fonts.googleapis.com/css?family=Ubuntu:700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Odibee+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Public+Sans&display=swap" rel="stylesheet">
    
    <style>
     body{
            max-width: 1400px;
            margin:0px;
            margin-bottom: 40px;
        }

        .navigation_bar {
            list-style-type: none;
            width: 100%;
            margin-top:-100px;
            overflow: hidden;
            border-bottom-color: 1px solid rgb(42, 190, 42);
            position: fixed;
            background-color: white;
            border-bottom: 1px solid rgb(85, 84, 84);
        }

        li {
            float: left;
            padding:20px;
            margin-left: 30px;
        }

        li:hover{
            border-bottom: 2px solid rgb(165, 247, 189);
        }

        li a{
            text-decoration: none;
            color: black;
            font-size: 20px;
            font-family: 'Ubuntu', sans-serif;
        }


        .float_account{
            float: right;
            margin-right: 80px;
        }

        .btn{
            border: 2px solid black;
            background-color: white;
            font-size: 15px;
            cursor: pointer;
            padding:5px;
            margin-left:20px;
        }
    </style>
   
</head>

<body>
    <ul class="navigation_bar">
        <li><a href="host_home.php">HOME</a></li>
        <li><a href="host_book.php">BOOKING</a></li>
		<li><a href="hostplace_create.php">CREATE</a></li>
        <li class="float_account" style="border-bottom: 2px solid rgb(47, 199, 93);"><a href="host_profile.php">ACCOUNT</a></li>
    </ul>
	
	

	<div class="container" style="margin-top:100px; margin-left:70px;">
		
		<h1 style="margin-top:20px;">Request</h1>
		<?php
				while($row = mysqli_fetch_array($result)){
					$place_id = $row['place_id'];
					$sql2 = "select * from hostplace where place_id=$place_id";
					$result2 = mysqli_query($conn,$sql2);
					while ($row2 = mysqli_fetch_array($result2)){
						$title = $row2['place_name'];
						$status = $row['status'];
						$opentime = $row2['open_time'];
						$closetime = $row2['close_time'];
						$booked = $row['booked'];
						echo '<div class="post-box">';
						echo '<table>';
						echo '<tr>';
						echo '<td style="width:25%;">';
						echo '<img src="upload_image/'.$row2["image"].'"style="width:400px;height:300px;">';
						echo '</td>';
						echo '<td style="width:60%;padding-left:20px;">';
						echo '<h1>'.$title.'</h2>';
						echo '<h2>Date : '.$booked.'</h1>';
						echo '<h2>Time : '.$opentime.' - '.$closetime.'</h1>';
						echo '<form method="POST" action="jump.php?id='.$place_id.'">';
						echo '<div style="padding-top:10px">';
						echo	'<input type="submit" name="submit" value="Accept" class="btn">';
						echo	'<input type="submit" name="submit" value="Reject" class="btn" style="color: grey; border: 2px solid grey;">';
						echo '</div>';
						echo '</form>';
						echo '</td>';
						echo '</tr>';
						echo '</table>';
						echo '</div>';
		
					}					
				}
		?>
		
		
		
		
		


	</div>
</body>


</html>
