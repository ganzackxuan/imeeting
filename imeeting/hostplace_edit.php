 <?php
 
session_start();
if (!isset($_SESSION['loggedin'])){
	header('Location: login.html');
	exit();
}
if ($_SESSION['type']===0){
	header ('Location: rent_home.php');
}
$place_id = $_GET['post_id'];

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$db = "imeeting";

$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

if (!$conn) {
 die("Connection failed: " . mysqli_connect_error());
}

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
	$postalcode = $row['postalcode'];
	$open_time = $row['open_time'];
	$close_time = $row['close_time'];
}

if(isset($_POST['submit']))
{
   $name = $_FILES['image']['name'];
 
   
   $textareaValue = $_POST['description'];
   $street = $_POST['street'];
   $postalcode = $_POST['postal_code'];
   $city = $_POST['city'];
   $state = $_POST['state'];
   $other = $_POST['other'];
   $chk="";

   $payment = $_POST['payment'];
   
   
   $open_time = $_POST['open_time'];
   $close_time = $_POST['close_time'];

	$target_dir = "upload_image/";
	$target_file = $target_dir . basename($_FILES["image"]["name"]);

	// Select file type
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	// Valid file extensions
	$extensions_arr = array("jpg","jpeg","png","gif");
   
   $id = "zackxuan";

	// Check extension
	if( in_array($imageFileType,$extensions_arr) ){
	   
		//update information
		$query = "UPDATE `hostplace` SET `image`='$name',`description`='$textareaValue',`street`='$street',`postalcode`='$postalcode',`city`='$city',`state`='$state',`open_time`='$open_time',`close_time`='$close_time',`payment`='$payment' WHERE place_id=$place_id";

		mysqli_query($conn, $query);
		
	   move_uploaded_file($_FILES['image']['tmp_name'],$target_dir.$name);

	} else{
		$query = "UPDATE `hostplace` SET `description`='$textareaValue',`street`='$street',`postalcode`='$postalcode',`city`='$city',`state`='$state',`open_time`='$open_time',`close_time`='$close_time',`payment`='$payment' WHERE place_id=$place_id";

		mysqli_query($conn, $query);
	}
}


?>

<!DOCTYPE html>
<head>
    <title>Edit Host Place</title>

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
            z-index: 30;
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

        .place_img{
            width:200px;
            height:200px;
            border-radius: 10px;
            margin-top:20px;
        }

        .info_box{
            margin-left:70px;
            align-items: center;
        }

        .edit_btn{
            margin-left: 60px;
        }

        .flex-box{
            display: flex;
            flex-direction: row;
        }

        .edit_cflex{
            display: flex;
            flex-direction: column;
        }

        .edit_title{
            margin-left: 20px;
            font-size: 20px;
            font-family: 'Ubuntu', sans-serif;
        }

        .input_field{
            margin-top:10px;
            margin-left: 20px;
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
            padding: 5px;
        }

        #map{
            margin-left: 20px;
            background-color: grey;
            width: 700px;
            height: 350px;
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
		<li style="border-bottom: 2px solid rgb(47, 199, 93);"><a href="hostplace_create.php">CREATE</a></li>
        <li class="float_account"><a href="host_profile.php">ACCOUNT</a></li>
    </ul>
    
    <div style="margin-top:100px;">
        <p class="title"><u>Edit Host Place</u></p>

        <div class="info_box">
            <div class="flex-box">
                <div  id="content" class="edit_cflex">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <input type="hidden" name="size" value="100000">
                        <div>
                            <input type="file" name="image">
                        </div>
                        <div class="place_img">
                        <?php
                          $image_src = "upload_image/".$image;
                          ?>
                          <img class="place_img" src='<?php echo $image_src;  ?>' >
                        </div>
                </div>
                <div>
                        <div style="margin-left: 31px;">
                                <a class="edit_title"><u>Description</u></a><br>
                                <textarea class="input_field" type="text" name="description" placeholder="Tell us about your place..." style="width: 790px;" rows="7" maxlength="256" 
                                    ><?php echo $description ?></textarea>
                                <br><br>
                        </div>

                        <div style="margin-left: 31px;">
                                <a class="edit_title"><u>Address</u></a><br>



                                    <a class="input_field">- OR -</a><br><br>

                                    <a class="edit_title">Street</a><br>
                                    <input class="input_field" type="text" name="street" placeholder="Jalan Lama"
                
                                    value = "<?php
                                        echo $street;
                                        
                                    ?>"

                                    style="width:790px;" maxlength="31"><br><br>
                                                        

                                <div style="display: flex; flex-direction: row;">
                                    <div>
                                            <a class="edit_title">Postal Code</a><br>
                                            <input  class="input_field" type="number" name="postal_code" placeholder="71000"
                                    
                                            value = "<?php
                                                echo $postalcode;
                                                
                                            ?>"
                                            style="width:120px;" maxlength="8"><br><br>
                                    </div>
                                    <div style="margin-left:30px;">
                                            <a class="edit_title">City</a><br>
                                            <input  class="input_field" type="text" name="city" placeholder="Port Dickson"
                                            value = "<?php
                                                echo $city;
                                                
                                            ?>"
                                

                                            style="width:250px;" maxlength="21"><br><br>
                                    </div>

                                    <div style="margin-left:30px;">
                                            <a class="edit_title">State</a><br>
                                            <input  class="input_field" type="text" name="state" placeholder="Negeri Sembilan"

                                            value = "<?php
                                                echo $state;
                                                
                                            ?>"

                                            style="width:250px;" maxlength="21"><br><br><br>
                                    </div>
                                </div>

                                <a class="edit_title" type="text" name="facilities"><u>Facilities/Characteristics</u></a><br>
                                
                                    <input  class="input_field" type="checkbox" name="faci[]" value="Wifi">Wifi Support<br>
                                    <input  class="input_field" type="checkbox" name="faci[]" value="Projector">Projector<br>
                                    <input  class="input_field" type="checkbox" name="faci[]" value="Chalkboard">Chalkboard<br>
                                    <input  class="input_field" type="checkbox" name="faci[]" value="Sound_ins">Well Sound Insulation <br>
                                    <input  class="input_field" type="checkbox" name="faci[]" value="Water">Water Dispenser<br>
                                    <a style="margin-left:20px;"> :</a><input class="input_field" type="text" name="other" placeholder=""
                                    value = "<?php
                                        
                                        
                                    ?>"
                                    style="width:300px; height: 30px; margin-left: 10px;" maxlength="21">
                                    <br><br>
                               

                             
                                <a class="edit_title"><u>Operation Time</u></a><br>
                                <select class="input_field" type="varchar" name="open_time">
                                <option  value="<?php
                                        echo $open_time;
                                        
                                        ?>" selected>
                                    <?php
                                        echo $open_time;
                                        
                                    ?>
                                </option>
                                        <option value="06:00">06:00</option>
                                        <option value="07:00">07:00</option>
                                        <option value="08:00">08:00</option>
                                        <option value="09:00">09:00</option>
                                        <option value="10:00">10:00</option>
                                        <option value="11:00">11:00</option>
                                        <option value="12:00">12:00</option>
                                        <option value="13:00">13:00</option>
                                        <option value="14:00">14:00</option>
                                        <option value="15:00">15:00</option>
                                        <option value="16:00">16:00</option>
                                        <option value="17:00">17:00</option>
                                        <option value="18:00">18:00</option>
                                        <option value="19:00">19:00</option>
                                        <option value="20:00">20:00</option>
                                        <option value="21:00">21:00</option>
                                        <option value="22:00">22:00</option>
                                        <option value="23:00">23:00</option>
                                        <option value="00:00">00:00</option>
                                </select>
                                <a class="input_field"> to</a>
                                <select class="input_field" type="varchar" name="close_time" >
                                <option  value="<?php
                                        echo $close_time;
                                        
                                        ?>" selected>
                                    <?php
                                        echo $close_time;
                                        
                                    ?>
                                </option>
                                        <option value="07:00">07:00</option>
                                        <option value="08:00">08:00</option>
                                        <option value="09:00">09:00</option>
                                        <option value="10:00">10:00</option>
                                        <option value="11:00">11:00</option>
                                        <option value="12:00">12:00</option>
                                        <option value="13:00">13:00</option>
                                        <option value="14:00">14:00</option>
                                        <option value="15:00">15:00</option>
                                        <option value="16:00">16:00</option>
                                        <option value="17:00">17:00</option>
                                        <option value="18:00">18:00</option>
                                        <option value="19:00">19:00</option>
                                        <option value="20:00">20:00</option>
                                        <option value="21:00">21:00</option>
                                        <option value="22:00">22:00</option>
                                        <option value="23:00">23:00</option>
                                        <option value="00:00">00:00</option>
                                </select>
                               
                                <br><br>

                                <a class="edit_title"><u>Payment Amount</u></a><br>
                                <input  class="input_field" type="number" name="payment" placeholder="10"
                                value = "<?php
                                    echo $payment;
                                    
                                ?>"
                        
                                style="width:4em;" >
                                <a class="edit_title">RM / day</a><br><br><br>

                                <div>
                                    <input type="submit" name="submit" value="SUBMIT" class="btn">
                                </div>

                                <a href="./host_home.html"><button class="btn" style="color: grey; border: 2px solid grey;"><b>CANCEL</b></button></a>

                                <br>
                    
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>


   

</body>


</html>
