<?php

$place_id = $_GET['post_id'];
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$db = "imeeting";
					 
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
					 
$sql = "select * from hostplace where place_id=$place_id";
$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_array($result)){
	$placename = $row['place_name'];
	$payment = $row['payment'];
	$image = $row['image'];
	$street = $row['street'];
	$city = $row['city'];
	$state = $row['state'];
	$description = $row['description'];
	$host_id = $row['host_id'];
	$open_time = $row['open_time'];
	$close_time = $row['close_time'];
}

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$db = "imeeting";
					 
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
					 
$sql = "select * from user where user_id=$host_id";
$resultt = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($resultt)){
    $host_name = $row['f_name'].' '.$row['l_name'];
    $hostimage = $row['image'];
}

?>
<!DOCTYPE html>
<head>
    <title>Venue Detail</title>
    
<script type="text/javascript" src="show.js"></script>

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApYMvUymFF6P9NYRy9P9XiEu4GdCrXLSI&callback=loadMap">
</script>

    <link href="https://fonts.googleapis.com/css?family=Ubuntu:700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Odibee+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Public+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amaranth&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Advent+Pro:500&display=swap" rel="stylesheet">

    <style media="screen"> 
        body{
            max-width: 1300px;
            margin:0px;
            margin-bottom: 40px;
        }

        .navigation_bar {
            list-style-type: none;
            width: 100%;
            margin-top:-65px;
            overflow: hidden;
            border-bottom-color: 1px solid rgb(42, 190, 42);
            position: fixed;
            background-color: white;
            border-bottom: 1px solid rgb(85, 84, 84);
        }

        .nav_choice{
            float: left;
            padding:20px;
            margin-left: 30px;
        }

        .nav_choice:hover{
            border-bottom: 2px solid rgb(165, 247, 189);
        }

        li a{
            text-decoration: none;
            color: black;
            font-size: 20px;
            font-family: 'Ubuntu', sans-serif;
        }

        .float_account{
            padding:20px;
            float: right;
            margin-right: 80px;
        }

        .float_account:hover{
            border-bottom: 2px solid rgb(165, 247, 189);
        }

        ::-webkit-scrollbar{
            width: 1px;
        }

        .information_box{
            width: 1040px;
            margin-top:65px;
            margin-left: 70px;
        }

        img{
            width: 1040px;
            height: 400px;
            margin-left: -70px;
        }

        .rating_column{
            margin-top:1px;
            position: fixed;
            width: 380px;
            height: 100%;
            border-left: 1px solid black;
            right: 0;
            padding-left: 10px;
            padding-right: 10px;
            overflow-y: auto;
            background-color: white;
        }

        .host_bar{
            margin-top:-20px;
            width: 950px;
            display: flex;
            align-items: center;
            flex-direction: row;
        }

        .title{
            font-size: 30px;
            font-family: 'Ubuntu', sans-serif;
        }

        .title_description{
            font-size: 20px;
            font-family: 'Public Sans', sans-serif;
        }

        .host_img{
            width: 100px;
            height: 100px;
            border-radius: 50px;
        }

        .detail_title{
            margin-top:50px;
            font-size: 25px;
            font-family: 'Ubuntu', sans-serif;
        }

        .detail_description{
            font-size: 20px;
            font-family: 'Public Sans', sans-serif;
        }

        .ot_title{
            font-size:30px;
            font-family: 'Josefin Slab', serif;
        }

        .faci_list{
            font-size: 20px;
            padding:10px;
        }

        #map{
            background-color: grey;
            width: 900px;
            height: 400px;
        }

        .rating_img{
            margin-left: 10px;
            width: 70px;
            height: 70px;
            border-radius: 50px;
        }

        .rating_user{
            font-size: 20px;
            font-family: 'Ubuntu', sans-serif;
        }

        .rating_time{
            font-size: 15px;
            font-family: 'Public Sans', sans-serif;
        }

        .rating_cmt{
            margin-left: 10px;
            font-size: 14px;
            font-family: 'Public Sans', sans-serif;
        }

        .rating_booksc{
            margin-left: -10px;
            width: 400px;
            position: fixed;
            padding: 10px;
            display: flex; 
            flex-direction: row; 
            padding-top: 10px; 
            padding-bottom: 25px; 
            margin-top:10px; 
            align-items: center;
            bottom: 0px;
            border-top: 1px solid black;
            background-color: white;
        }

        .book_title{
            width: 200px;
            margin-top:10px;
            font-size: 25px;
            font-family: 'Advent Pro', sans-serif;
        }

        .book_btntitle{
            margin-top:10px;
            font-size: 20px;
            font-family: 'Advent Pro', sans-serif;
            background-color: rgb(183, 255, 183);
            border: 0px;
            padding: 5px;
            cursor: pointer;
        }

        @media screen and (max-width: 1024px){
            .rating_column{
                display:none;
            }

            .float_account{
                display:none;
            }
		}

    </style>
</head>

<body>
    <ul class="navigation_bar">
        <li style="border-bottom: 2px solid rgb(47, 199, 93);" class="nav_choice"><a href="rent_home.php">HOME</a></li>
        <li class="nav_choice"><a href="user_book.php">BOOKING</a></li>
        <li class="float_account"><a href="nuser_profile.php">ACCOUNT</a></li>
    </ul>

	<?php
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$db = "imeeting";
						 
	$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
	$sql = "SELECT COUNT(*) AS total  FROM `comments` WHERE post_id=$place_id";
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);
	$total = $row['total'];
	?>
    <div class="rating_column">
            <div style="display: flex; flex-direction: row;">
                <a class="detail_title" style="margin-top:20px;" id="price">
                    <?php
						echo 'Reviews('.$total.')'; 
					?> 
                </a>
              
            </div><br>
			<?php
			
			$dbhost = "localhost";
			$dbuser = "root";
			$dbpass = "";
			$db = "imeeting";
								 
			$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
								 
			$sql = "select * from comments where post_id=$place_id";
			$result = mysqli_query($conn,$sql);
			while($row = mysqli_fetch_array($result)){
				echo '<div style="border-top: 1px solid rgb(206, 206, 206);">';
                echo '<div style="display: flex; flex-direction: row; padding-top: 10px; padding-bottom: 10px; margin-top:10px; align-items: center;">';
                echo        '<img src="./upload_image/'.$row['image'].'" class="rating_img">';
                echo        '<div style="display: flex; flex-direction: column; margin-left: 10px;">';
                echo                '<a class="rating_user">'.$row['full_name'].'</a>';
                echo                '<a class="rating_time">'.$row['date'].'</a>';
                echo        '</div>';
                echo '</div>';

                echo '<div class="rating_cmt">';
                echo     '<p>'.$row['comment'].'</p>';
                echo '</div>';
				echo '</div>';
			}
			?>
			

            <div class="rating_booksc">
                <a class="book_title">
                <?php
                    echo "RM ".$payment." / hour";
                ?>
                </a>
				<?php $url = 'booking_table.php?id=' .$place_id; ?>
                <a href=<?=$url?> style="margin-left: 120px;"><button class="book_btntitle" id="book_btn">BOOK</button></a>
            </div>
    </div>

    <div class="information_box">
        <?php
        $image_src = "upload_image/".$image;
        ?>
        <img src='<?php echo $image_src;  ?>' >

        <p class="title">
            <?php
                echo $placename;
            ?>
        </p>

        <div class="host_bar">
            <a style="width:600px; ">
                    <p class="title_description">
                    <?php
                       echo $street.", ";
                       echo $city.", ";
                       echo $state;
                    ?>
                    </p>
                    <p class="title_description" id="host">
                    <?php
                        							
                            echo "Hosted by ".$host_name;
                        
                    ?>
                    </p>
            </a>
            <a style="margin-left: 310px; ">
                    <?php
                    $image_src = "upload_image/".$hostimage;
                    ?>
                    <img class="host_img" src='<?php echo $image_src;  ?>' name="hostimage">
            </a>
        </div>

        <div style="max-width: 950px;">
            <p class="detail_title">About</p>
            <p class="detail_description">
            <?php
                echo $description;
                
            ?>
            </p> 
        </div>

        <div style="max-width: 950px;">
                <p class="detail_title">Facilities</p>
                <p class="detail_description" >
                    <ul>
                        <li class="faci_list">Wifi Support</li>
                        <li class="faci_list">Projector and Chalkboard</li>
                        <li class="faci_list">Good Sound insulation</li>
                    </ul>
                </p> 
        </div>

        <p class="detail_title">Operating Time</p>
        <div class="host_bar">
                <a style="text-align: center;">
                        <p class="ot_title">Open At </p>
                        <p class="title_description" style="font-size:26px;" id="host">
                        <?php
                            echo $open_time;
                        ?>
                        </p>
                </a>
                <a style="text-align: center;margin-left: 100px">
                    <p style="font-size: 50px; color: grey;">/</p>
                </a>
                <a style="margin-left: 100px; text-align: center;">
                        <p class="ot_title">Close At </p>
                        <p class="title_description" style="font-size:26px;"id="host">
                        <?php
                            echo $close_time;
                        ?>
                        </p>
                </a>
            </div>

            
    </div>
</body>


</html>
