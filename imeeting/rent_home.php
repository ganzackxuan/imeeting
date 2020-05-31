<?php
session_start();
if (!isset($_SESSION['loggedin'])){
	header('Location: login.html');
	exit();
}
if ($_SESSION['type'] == 1){
	header('Location: host_home.php');
	exit();
}

?>
<!DOCTYPE html>
<head>
    <title>Home</title>

    <link href="https://fonts.googleapis.com/css?family=Ubuntu:700&display=swap" rel="stylesheet">
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
        
        .container{
            text-decoration: none;
            list-style-type: none;
            color:black;
            margin-left:31px;
            margin-top:20px;
        }

        .container+.container{
            margin-left: 50px;
        }

        .item{
            width:285px;
            height:380px;
        }

        .place_name{
            text-decoration: none;
            color: black;
            font-size: 20px;
            margin-top:5px;
            font-family: 'Ubuntu', sans-serif;
        }
        .location{
            text-decoration: none;
            color: black;
            margin-top:-15px;
            font-size:16px;
            font-family: 'Public Sans', sans-serif;
        }
        .fee{
            text-decoration: none;
            color: black;
            margin-top:20px;
            font-size:16px;
            font-family: 'Public Sans', sans-serif;
        }

        img{
            width:285px;
            height:200px;
        }

        .item_box{
            overflow: auto;
            flex-direction: row;
            display: flex;
        }

        .title{
            margin-top:30px;
            font-size: 35px;
            font-family: 'Ubuntu', sans-serif;
            margin-left:70px;
        }

        .title_description{
            margin-top:-30px;
            font-family: 'Public Sans', sans-serif;
            margin-left:70px;
        }

        ::-webkit-scrollbar{
            width: 1px;
        }
    </style>
</head>

<body>
    <ul class="navigation_bar">
        <li style="border-bottom: 2px solid rgb(47, 199, 93);"><a href="rent_home.php">HOME</a></li>
        <li><a href="user_book.php">BOOKING</a></li>
        <li class="float_account"><a href="nuser_profile.php">ACCOUNT</a></li>
    </ul>

    <form style="margin-top:100px; text-align: center;" method="GET" action="search.php">
        <input type="text" name='search' id="search" placeholder="Search" style="width: 100%; padding:10px; font-size: 20px; border: 2px solid black; border-radius: 100px;" >
    </form>
    
    <p class="title">Near Me</p>
    <p class="title_description">Discover beautiful and clean meeting room around you.</p>

    <form>
    <div class="item_box"style="margin-left:40px; margin-top:20px; ">

       <?php
           $dbhost = "localhost";
           $dbuser = "root";
           $dbpass = "";
           $db = "imeeting";
                                
           $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
           $city = $_SESSION['city'];               
           $sql = "select * from hostplace WHERE city= '$city'";
           $result = mysqli_query($conn,$sql);

           while($row = mysqli_fetch_array($result)){
			   $url = 'venue_detail.php?post_id=' .$row['place_id'];
               echo "<a href=$url class='container'>";
               echo "<div class='item'>";
                   echo "<img src='upload_image/".$row['image']."'>";
                   echo "<p class='place_name'>".$row['place_name']."</p>";
                   echo "<p class='location'>".$row['city'].", ".$row['state']."</p>";
               echo "<p class='fee'>"."$".$row['payment']." / hour</p>";
               echo"</div>";
               echo"</a>";
           }
       ?>

    </div>

    <p class="title" style="margin-top: 30px;">Most Popular</p>
    <p class="title_description">Some of the most popular choices in your country!</p>

    <div class="item_box"style="margin-left:40px; margin-top:20px; ">
        
        <?php
           $dbhost = "localhost";
           $dbuser = "root";
           $dbpass = "";
           $db = "imeeting";
                                
           $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
           $city = $_SESSION['city'];               
           $sql = "select * from hostplace WHERE 1";
           $result = mysqli_query($conn,$sql);

           while($row = mysqli_fetch_array($result)){
			   $url = 'venue_detail.php?post_id=' .$row['place_id'];
               echo "<a href=$url class='container'>";
               echo "<div class='item'>";
                   echo "<img src='upload_image/".$row['image']."'>";
                   echo "<p class='place_name'>".$row['place_name']."</p>";
                   echo "<p class='location'>".$row['city'].", ".$row['state']."</p>";
               echo "<p class='fee'>"."$".$row['payment']." / hour</p>";
               echo"</div>";
               echo"</a>";
           }
       ?>
    </div>
    </form>

   

</body>


</html>
