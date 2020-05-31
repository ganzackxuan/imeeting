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
						 
	$sql = "select * from user where user_id=$id";
	$result = mysqli_query($conn,$sql);
	
	while($row = mysqli_fetch_array($result)){
		$email = $row['email'];
		$password = $row['password'];
		$f_name = $row['f_name'];
		$l_name = $row['l_name'];
		$age = $row['age'];
		$city = $row['city'];
		$state = $row['state'];
		$countrycode = $row['countrycode'];
		$phonenumber = $row['phonenumber'];
		$image = $row['image'];
		$bankaccount = $row['bankaccount'];
		$bank = $row['bank'];
	}

?>

<!DOCTYPE html>
<head>
    <title>Profile</title>

    <link href="https://fonts.googleapis.com/css?family=Ubuntu:700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Odibee+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Public+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amaranth&display=swap" rel="stylesheet">

    <style>
        body{
            max-width: 1400px;
            margin:0px;
            margin-bottom: 40px;
        }

        .navigation_bar {
            list-style-type: none;
            width: 100%;
            margin-top:-110px;
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
        
        .container{
            text-decoration: none;
            list-style-type: none;
            color:black;
            margin-left:31px;
            margin-top:20px;
        }

        .item{
            width:300px;
            height:380px;
            border-top:2px solid rgb(218, 218, 218);
            border-right:2px solid rgb(218, 218, 218);
            border-bottom: 1px solid grey;
        }

        ::-webkit-scrollbar{
            width: 1px;
        }

        .input_field{
            margin-top:10px;
            font-family: 'Montserrat', sans-serif;
            font-size: 18px;
            padding: 5px;
        }

        .information_box{
            margin-top:110px; 
            margin-left:70px; 
            padding-left:20px; 
        }

        img{
            width:300px;
            height:300px;
            border-radius: 200px;
        }

        .display{
            margin-top:80px;
        }

        .navi_editprofile{
            font-size: 25px; 
            font-family: 'Amaranth', sans-serif;
            color: dimgray;
        }

        .title{
            margin-top:30px;
            font-size: 35px;
            font-family: 'Ubuntu', sans-serif;
        }

        .bio{
            font-size: 25px;
            font-family: 'Public Sans', sans-serif;
            padding-top:6px;
            margin-left: 10px;
            
        }

        .bio_img{
            height: 40px;
            width: 40px;
        }

        .bio_box{
            display: flex; 
            flex-direction: row;
        }

        .bio_box+.bio_box{
            margin-top:30px;
        }

    </style>
</head>

<body>
    <ul class="navigation_bar">
        <li><a href="rent_home.php">HOME</a></li>
        <li><a href="user_book.php">BOOKING</a></li>
        <li class="float_account" style="border-bottom: 2px solid rgb(47, 199, 93);"><a href="">ACCOUNT</a></li>
    </ul>

    <div class="information_box">
            <div style="display: flex;">
            <?php
            $image_src = "upload_image/".$image;
            ?>
            <img src='<?php echo $image_src;  ?>' ><br><br><br></a>
                <div class="display">
                    <a style=" margin-left: 31px; font-size: 28px; font-family: 'Public Sans', sans-serif;" >Welcome,<br></a>
                    <a style=" margin-left: 31px; font-size: 60px; font-family: 'Amaranth', sans-serif;" id="id_name">
                    <?php
                        echo $l_name;
                        
                    ?>
                    <br></a>
                    <a href="./nedit_profile.php" style=" margin-left: 31px; " class="navi_editprofile">Edit Profile</a>
					<a href="logout.php" style=" margin-left: 31px; " class="navi_editprofile">Logout</a>
                </div>    
            </div>
    </div>

    <div class="information_box" style="margin-top:10px; margin-left:100px;">
        <p2 class="title"><u>About</u></p2><br><br>
        <div class="bio_box"> 
            <img src="images/home-24px.svg" class="bio_img">
            <p2 class="bio" id="address">
            <?php
                    echo "Lives in ".$city.", ".$state;
                
            ?>
            </p2>
        </div>
        <div class="bio_box" > 
            <img src="images/cake-24px.svg" class="bio_img">
            <p2 class="bio" id="age">
            <?php
                echo $age." years old";
                
            ?>
            </p2>
        </div>
        <div class="bio_box" > 
            <img src="images/email-24px.svg" class="bio_img">
            <p2 class="bio" id="email_username">
            <?php
                echo $email;
                
            ?>
            </p2>
        </div>
        <div class="bio_box" > 
            <img src="images/smartphone-24px.svg" class="bio_img">
            <p2 class="bio" id="phone">
            <?php
                echo $countrycode." ".$phonenumber	;
                
            ?>
            </p2>
        </div>
    </div>

</body>


</html>
