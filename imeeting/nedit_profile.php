<?php
session_start();
if (!isset($_SESSION['loggedin'])){
	header('Location: login.html');
	exit();
}
	$id = (string)$_SESSION['id'];
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "imeeting";
    
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
    
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    
    if(isset($_POST['submit']))
    {
        $name = $_FILES["image"]["name"];
        
        $password = $_POST['password'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $age = $_POST['age'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $countrycode = $_POST['countrycode'];
        $phonenumber = $_POST['phonenumber'];
		
         $target_dir = $_SERVER['DOCUMENT_ROOT'].'/imeeting/upload_image/'.$name;
         $target_file = $_FILES["image"]["name"];

         // Select file type
         $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

         // Valid file extensions
         $extensions_arr = array("jpg","jpeg","png","gif");
        

         // Check extension
         if( in_array($imageFileType,$extensions_arr) ){
            
             //update information
             $query = "UPDATE `user` SET `image`='$name',`password`='$password',`f_name`='$firstname',`l_name`='$lastname',`age`='$age',`city`='$city',`state`='$state',`countrycode`='$countrycode',`phonenumber`='$phonenumber' WHERE user_id = $id";
			 mysqli_query($conn, $query);
             
             move_uploaded_file($_FILES["image"]["tmp_name"],  $target_dir);

         }else{
			 $query = "UPDATE `user` SET`password`='$password',`f_name`='$firstname',`l_name`='$lastname',`age`='$age',`city`='$city',`state`='$state',`countrycode`='$countrycode',`phonenumber`='$phonenumber' WHERE user_id = $id";
			 mysqli_query($conn, $query);
		 }
        
    }
	
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
    <title>Edit Profile Page</title>

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
            width:200px;
            height:200px;
            border-radius: 15px;
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
            margin-left:20px;
            margin-top:10px;
            font-family: 'Montserrat', sans-serif;
            font-size: 18px;
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
        <li><a href="rent_home.php">HOME</a></li>
        <li><a href="user_book.php">BOOKING</a></li>
        <li class="float_account" style="border-bottom: 2px solid rgb(47, 199, 93);"><a href="nuser_profile.php">ACCOUNT</a></li>
    </ul>
    
    <div style="margin-top:100px;">
        <p class="title"><u>Edit Profile</u></p>

        <div class="info_box">
            <div class="flex-box">
                <div class="edit_cflex">
                <form method="POST" action="" enctype="multipart/form-data">
                    <input type="hidden" name="size" value="100000">
                    <div>
                        <input type="file" name="image"
                        value="<?php
						echo $image;
                        ?>">
                    </div>
                    <div>
                    <?php
                      $image_src = "upload_image/".$image;
                      ?>
                      <img class="profile_img" src='<?php echo $image_src;  ?>' >
                    </div>
                </div> 
                <div style="margin-left: 50px;">
                        <a class="edit_title" style="margin-left: 20px;">
                        <?php
                                   echo "Email : ".$email;
                                    
                        ?>
                        <br><br></a>
                        <a class="edit_title">Password<br><input  class="input_field" type="varchar" name="password"
                        value="<?php
                                    echo $password;
                                    
                                ?>"
                        placeholder="Enter Password" style="width:350px; margin-left: 20px;" maxlength="21"><br><br></a>
                        <div style="display: flex; border-top: 1px solid rgb(231, 230, 230); padding-top:20px;">
                                <a class="edit_title">First Name<br><input  class="input_field" type="text" name="firstname"
                                value="<?php
                                            echo $f_name;
                                            
                                        ?>"
                                placeholder="Gan" style="width:200px; margin-left: 0px;" maxlength="15"><br><br></a>
                                <a class="edit_title">Last Name<br><input  class="input_field" type="text" name="lastname"
                                value="<?php
                                    echo $l_name;
                                    
                                ?>"
                                placeholder="Zack Xuan" style="width:250px; margin-left: 0px;" maxlength="21"><br><br></a>
                                
                        </div>
                        
                        <a class="edit_title" >Age<br><input  class="input_field" type="number" name="age" placeholder="21"
                        value="<?php
                            echo $age;
                            
                        ?>"
                        style="width:50px;" maxlength="3"><br><br></a>


                                <div style="display: flex; flex-direction: row;"> 
                                        <div>
                                                <a class="edit_title">City</a><br>
                                                <input  class="input_field" type="text" name="city" placeholder="Port Dickson"
                                                value="<?php
                                                    echo $city;
                                                    
                                                ?>"
                                                
                                                style="width:250px;" maxlength="21"><br><br>
                                        </div>
        
                                        <div style="margin-left:30px;">
                                                <a class="edit_title">State</a><br>
                                                <input  class="input_field" type="text" name="state" placeholder="Negeri Sembilan"
                                                value="<?php
                                                    echo $state;
                                                    
                                                ?>"
                                                
                                                style="width:250px;" maxlength="21"><br><br><br>
                                        </div>
                                </div>
                                

                                <a class="edit_title"><u>Phone Number</u><br>
                                <select  class="input_field" type="varchar" name="countrycode">
                                <option  value="<?php
                                        echo $countrycode;
                                        
                                        ?>" selected>
                                    <?php
                                        echo $countrycode;
                                        
                                    ?>
                                </option>
                                <option value="+60(Malaysia) ">+60 (Malaysia)</option>
                                <option value="+65(Singapore) ">+65 (Singapore)</option>
                                </select>
                                <input  class="input_field" type="varchar" name="phonenumber" placeholder="0142322159"
                                value="<?php
                                    echo $phonenumber;
                                    
                                ?>"
                                
                                style="width:150px; margin-left: 10px;" maxlength="15">
                                <br><br><br></a>

                                 <div>
                                    <input type="submit" name="submit" value="SUBMIT" class="btn">
                                </div>
                                <a href="nuser_profile.php"><button class="btn" style="color: grey; border: 2px solid grey;"><b>CANCEL</b></button></a>
                    
                                
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


   

</body>


</html>
