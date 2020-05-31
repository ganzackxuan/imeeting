<?php

session_start();
if (!isset($_SESSION['loggedin'])){
	header('Location: login.html');
	exit();
}
$full_name = $_SESSION['full_name'];
$user_image = $_SESSION['image'];
$renter_id = $_SESSION['id'];
$post_id = $_GET['id'];

    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "imeeting";
    
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
    
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
	
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$db = "imeeting";
	
	$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
	
	$sql = "select * from hostplace where place_id = $post_id" ;
	$result = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($result);

	$image = $row['image'];
	$image_src = "upload_image/".$image;

    
    if(isset($_POST['submit']))
    {
		$comment = $_POST['description'];
		$rating = $_POST['myRange'];
		
		
		$query = "insert into comments(post_id,full_name,comment,image,rating) 
					values('".$post_id."','".$full_name."','".$comment."','".$user_image."','".$rating."')";
		mysqli_query($conn,$query);
	    
		$query = "UPDATE `booking` SET `status`='Rated' WHERE renter_id=$renter_id and place_id=$post_id";
		mysqli_query($conn, $query);
		
		header('Location: user_book.php');
		
    }
?>

<!DOCTYPE html>
<head>
    <title>Edit Profile Page</title>

    <link href="https://fonts.googleapis.com/css?family=Ubuntu:700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Odibee+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Public+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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

        .title{
            margin-top:30px;
            font-size: 35px;
            font-family: 'Ubuntu', sans-serif;
            margin-left:70px;

        }

        .title_description{
            margin-top:-30px;
            margin-left:70px;
            font-family: 'Public Sans', sans-serif;
            color: black;
            text-decoration: underline;
        }

        ::-webkit-scrollbar{
            width: 1px;
        }

        .profile_img{
            width:500px;
            height:300px;
            border-radius: 5px;
        }

        .info_box{
            margin-left:70px; 
            align-items: center;
        }

        .edit_btn{
            margin-left: 60px;
        }

        .edit_cflex{
            display: flex; 
            flex-direction: column;
            width:100%;
            align-items:center;
        }

        .edit_title{
            margin-left: 20px;
            font-size: 20px;
            font-family: 'Ubuntu', sans-serif;
        }

        .input_field{
            margin-left:20px;
            margin-top:10px;
            font-family: 'Montserrat', sans-serif;
            font-size: 18px;
            padding: 5px;
        }


        .btn{
            border: 2px solid black; 
            background-color: white; 
            font-size: 15px; 
            cursor: pointer; 
            padding:5px; 
            margin-left:20px;
            
        }
        
        .slidecontainer {
          width: 50%;
        }

        .slider {
          -webkit-appearance: none;
          width: 100%;
          height: 10px;
          border-radius: 5px;
          background: #d3d3d3;
          outline: none;
          opacity: 0.7;
          -webkit-transition: .2s;
          transition: opacity .2s;
            margin-left:47%;
        }

        .slider:hover {
          opacity: 1;
        }

        .slider::-webkit-slider-thumb {
          -webkit-appearance: none;
          appearance: none;
          width: 25px;
          height: 25px;
          border-radius: 50%;
          background: #4CAF50;
          cursor: pointer;
        }

        .slider::-moz-range-thumb {
          width: 23px;
          height: 24px;
          border: 0;
          background: #4CAF50;
          cursor: pointer;
        }
    </style>
</head>

<body>
    <ul class="navigation_bar">
        <li><a href="host_home.html">HOME</a></li>
        <li><a href="">BOOKING</a></li>
        <li class="float_account" style="border-bottom: 2px solid rgb(47, 199, 93);"><a href="./signup_host.html">ACCOUNT</a></li>
    </ul>
    
    <div style="margin-top:100px;">
        <form method="POST" action="" enctype="multipart/form-data">
        <div class="info_box">
            <div class="edit_cflex">
                
                <img class="profile_img" src='<?php echo $image_src;  ?>' >
            </div>
            <br>
            
             <div class="slidecontainer">
               <input type="range" min="1" max="5" value="1" class="slider" name="myRange" id="myRange">
                <p style="margin-left:90%">Rating : <span id="demo"></span></p>
             </div>

             <script>
             var slider = document.getElementById("myRange");
             var output = document.getElementById("demo");
             output.innerHTML = slider.value;

             slider.oninput = function() {
               output.innerHTML = this.value;
             }
             </script>
            
            <a class="edit_title" style="margin-left:42%">Give us a Comment</a><br>
            <textarea class="input_field" type="text" name="description" placeholder="" style="width: 790px; margin-left:18%" rows="11" maxlength="256"></textarea>
            
            <br><br>
            <div style="margin-left:40%">
                   <input type="submit" name="submit" value="SUBMIT" class="btn">
                   <a href="./profile.html"><button class="btn" style="color: grey; border: 2px solid grey;"><b>CANCEL</b></button></a>
            </div>
            </form>
        </div>
    

    <div>
                    
</body>


</html>
