<?php
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
	if ($stmt = $conn->prepare('SELECT user_id, full_name, password, type, city, state, age, countrycode, phonenumber, f_name, l_name, email FROM user WHERE username = ?')){
		//Bind parameter (s = string, i = int, b = blob, etc),username is string so "s"
		$stmt->bind_param('s',$_POST['email']);
		$stmt->execute();
		//Store the result so we can check if the account exists in the database.
		$stmt->store_result();
	}
	if ($stmt->num_rows == 0){
	   $email  = $_POST['email'];
	   $password = $_POST['password'];
	   $firstname = $_POST['firstname'];
       $lastname = $_POST['lastname'];
       $full_name = $firstname + $lastname;
	   $age = $_POST['age'];
	   $city = $_POST['city'];
	   $state = $_POST['state'];
	   $countrycode = $_POST['countrycode'];
	   $phonenumber = $_POST['phonenumber'];
	   $bankaccount = $_POST['bankaccount'];
       $bank = $_POST['bank'];
       $user_id = rand(10,10000);

		$query = "insert into user(user_id,full_name,username,email,password,f_name,l_name,age,city,state,countrycode,phonenumber,type, bankaccount, bank) 
					values('".$user_id."','".$full_name."','".$email."','".$email."','".$password."','".$firstname."','".$lastname."','".$age."','".$city."','".$state."','".$countrycode."','".$phonenumber."',1,'".$bankaccount."','".$bank."')";
        mysqli_query($conn,$query);
		header ('Location: login.html');
	}else{
		echo 'Email exists';
	}
}
?>


<!DOCTYPE html>
<head>
    <title>Sign Up</title>

    <link href="https://fonts.googleapis.com/css?family=Ubuntu:700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Odibee+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Public+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Sulphur+Point&display=swap" rel="stylesheet">

    <style>
        body{
            min-width: 1400px;
            width: 1400px !important;
            margin:0px;
            background-image: url('./images/meeting_user.jpg');
            background-size: cover;
        }

        .navigation_bar {
            min-width:700px;
            list-style-type: none;
            width: 100%;
            margin-top:-110px;
            overflow: hidden;
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
            border-bottom: 2px solid rgb(47, 199, 93);
        }

        .title{
            font-family: 'Ubuntu', sans-serif;
            font-size: 45px;
            margin-top: 10px;
        }

        .input_name{
            font-family: 'Public Sans', sans-serif;
            font-size: 22px;
        }

        .input_field{
            margin-top:10px;
            font-family: 'Montserrat', sans-serif;
            font-size: 18px;
            padding: 5px;
        }

        .submit_button{
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 8px;
            text-align: center;
            text-decoration: none;
            font-size: 22px;
            cursor: pointer;
            font-family: 'Sulphur Point', sans-serif;
            margin-bottom: 10px;
        }

        .signup_host{
            color:black;
            font-size:20px;
            font-family: 'Sulphur Point', sans-serif;
            word-spacing: -5px;
        }

        .flex_box{
            margin-top:110px;
            margin-left:70px;
            padding-left:20px;
            padding-right:20px;
            background-color: rgba(255, 255, 255, 0.97);
            width: 1250px;
            border: 3px solid rgb(223, 223, 223);
            border-radius: 5px;
        display:flex;
        }
        
       
    </style>
</head>

<body>
 
    <div class="flex_box" >
        <div>
            <p class="title">Sign Up</p>
            <form method="POST" action="" class="input_name" style="margin-top:-20px;" enctype="multipart/form-data">
                Email<br><input  class="input_field" type="varchar" name="email" placeholder="test@gmail.com" style="width:445px;" maxlength="38" required><br><br>
                Password<br><input  class="input_field" type="password" name="password" placeholder="" style="width:350px;" maxlength="21" required><br><br>
                <div style="display: flex; border-top: 2px solid rgb(231, 230, 230); padding-top:15px;">
                    <a>First Name<br><input  class="input_field" type="text" name="firstname" placeholder="Gan" style="width:200px;" maxlength="15" required><br><br></a>
                    <a style=" margin-left: 31px;">Last Name<br><input  class="input_field" type="text" name="lastname" placeholder="Zack Xuan" style="width:250px;" maxlength="21" required><br><br></a>
                <a style=" margin-left: 31px;">Age<br><input  class="input_field" type="number" name="age" placeholder="21" style="width:50px;" maxlength="3" required><br><br></a>
                </div>
                <div style="display: flex">
                    <a>City<br><input  class="input_field" type="text" name="city" placeholder="Port Dickson" style="width:250px;" maxlength="21" required><br><br></a>
                    <a style=" margin-left: 31px;">State<br><input  class="input_field" type="text" name="state" placeholder="Negeri Sembilan" style="width:250px;" maxlength="21" required><br><br></a>
                </div>
                <div style="display: flex">
                    <a>Phone Number<br>
                        <select  class="input_field" type="varchar" name="countrycode">
                            <option value="+60(Malaysia) ">+60 (Malaysia)</option>
                            <option value="+65(Singapore) ">+65 (Singapore)</option>
                        </select>
                        <input  class="input_field" type="varchar" name="phonenumber" placeholder="0142322159" style="width:150px; margin-left: 10px;" maxlength="15" required><br><br></a>
                </div>
                <div>
                    <input type="submit" name="submit" value="SUBMIT" class="submit_button">
                </div>
                <a href="login.html" class="signup_host">Already have a account? Click Here</a><br><br>
            </div>
            <div class="input_name" style="margin-top:87px;margin-left:150px;">
                Bank Account No.<br><input  class="input_field" type="varchar" name="bankaccount" placeholder="" style="width:420px;" maxlength="31"><br><br>
                Enter Your Bank<br><input  class="input_field" type="varchar" name="bank" placeholder="Maybank" style="width:420px;" maxlength="41"><br><br>
            </div>
            </form>
        </div>
    </div>

</body>


</html>
