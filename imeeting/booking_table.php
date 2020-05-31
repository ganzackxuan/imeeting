<?php
session_start();
$id = $_SESSION['id'];

$today = date("Y-m-d");
$nxt = date('Y-m-d', strtotime($today. ' + 1 days'));
$nxtt = date('Y-m-d', strtotime($nxt. ' + 1 days'));
$post_id = $_GET['id'];

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$db = "imeeting";

$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

$query = "SELECT host_id FROM hostplace WHERE place_id = $post_id";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)){
	$host_id = $row['host_id'];
}

$cytd = FALSE;
$ctoday = FALSE;
$cnxt = FALSE;
if (!$conn) {
 die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT date(date) AS datee FROM `booking` WHERE place_id='$post_id' AND date(date) >= $today AND date(date)<='$today'";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
	$cytd = TRUE;
}
$sql = "SELECT date(date) AS datee FROM `booking` WHERE place_id='$post_id' AND date(date) >= $nxt AND date(date)<='$nxt'";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
	$ctoday = TRUE;
}
$sql = "SELECT date(date) AS datee FROM `booking` WHERE place_id='$post_id' AND date(date) >= $nxtt AND date(date)<='$nxtt'";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
	$cnxt = TRUE;
}

if(isset($_POST['submit'])){
	//$datee = date()
	if ($_POST['submit']==='Confirm'){
		$cytd = FALSE;
		$ctoday = FALSE;
		$cnxt = FALSE;
		$nxt = $_POST['years'].'-'.$_POST['months'].'-'.$_POST['days'];
		$today = date('Y-m-d', strtotime($nxt. ' - 1 days'));
		$nxtt = date('Y-m-d', strtotime($nxt. ' + 1 days'));
		
		$sql = "SELECT date(date) AS datee FROM `booking` WHERE place_id='$post_id' AND date(date) >= '$nxt' AND date(date)<='$nxt'";
		$result = mysqli_query($conn,$sql);
		while($row = mysqli_fetch_array($result)){
			$ctoday = TRUE;
		}
		$sql = "SELECT date(date) AS datee FROM `booking` WHERE place_id='$post_id' AND date(date) >= '$today' AND date(date)<='$today'";
		$result = mysqli_query($conn,$sql);
		while($row = mysqli_fetch_array($result)){
			$cytd = TRUE;
		}
		$sql = "SELECT date(date) AS datee FROM `booking` WHERE place_id='$post_id' AND date(date) >= '$nxtt' AND date(date)<='$nxtt'";
		$result = mysqli_query($conn,$sql);
		while($row = mysqli_fetch_array($result)){
			$cnxt = TRUE;
		}
		$query = "INSERT INTO `booking`( `renter_id`, `place_id`, `date`, `status`, `host_id`) VALUES ($id,$post_id,date('$nxt'),'Pending',$host_id)";
		mysqli_query($conn, $query);
                                     
	}else{
		$cytd = FALSE;
		$ctoday = FALSE;
		$cnxt = FALSE;
		$nxt = $_POST['years'].'-'.$_POST['months'].'-'.$_POST['days'];
		$today = date('Y-m-d', strtotime($nxt. ' - 1 days'));
		$nxtt = date('Y-m-d', strtotime($nxt. ' + 1 days'));
		
		$sql = "SELECT date(date) AS datee FROM `booking` WHERE place_id='$post_id' AND date(date) >= '$nxt' AND date(date)<='$nxt'";
		$result = mysqli_query($conn,$sql);
		while($row = mysqli_fetch_array($result)){
			$ctoday = TRUE;
		}
		$sql = "SELECT date(date) AS datee FROM `booking` WHERE place_id='$post_id' AND date(date) >= '$today' AND date(date)<='$today'";
		$result = mysqli_query($conn,$sql);
		while($row = mysqli_fetch_array($result)){
			$cytd = TRUE;
		}
		$sql = "SELECT date(date) AS datee FROM `booking` WHERE place_id='$post_id' AND date(date) >= '$nxtt' AND date(date)<='$nxtt'";
		$result = mysqli_query($conn,$sql);
		while($row = mysqli_fetch_array($result)){
			$cnxt = TRUE;
		}
	}
	
}
                                 

?>


<!DOCTYPE html>
<head>
    <title>Booking Page</title>

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
            font-size: 35px;
            margin-top: 10px;
            text-align:center;
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

        .flex_box{
            margin-top:110px; 
            margin-left:70px; 
            padding-left:20px; 
            padding-right:20px;
        }

        .box{
            margin-left:90px;
            background-color: rgba(255, 255, 255, 0.97);
            border-radius: 5px;
        }

        table {
          font-family: arial, sans-serif;
          border-collapse: collapse;
          width: 80%;
            margin-left:90px;
        }

        td, th {
          border: 1px solid #dddddd;
            background-color:white;
          text-align: center;
          width:100px;
          height:20px;
        }

        tr:nth-child(even) {
          background-color: #dddddd;
        }

        .def{
            border: 1px solid #dddddd;
                 text-align: center;
                 width:50px;
                 height:40px;
        }

        ::-webkit-scrollbar{
            width: 1px;
        }
        
        .select-css {
            display: block;
            font-size: 20px;
            font-family: sans-serif;
            font-weight: normal;
            color: #444;
            line-height: 1.3;
            padding: 5px;
            width: 300px;
            max-width: 300px;
            box-sizing: border-box;
            margin: 0;
            border: 1px solid #aaa;
            box-shadow: 0 1px 0 1px rgba(0,0,0,.04);
            border-radius: .5em;
        }
        .select-css::-ms-expand {
            display: none;
        }
        .select-css:hover {
            border-color: #888;
        }
        .select-css:focus {
            border-color: #aaa;
            box-shadow: 0 0 1px 3px rgba(59, 153, 252, .7);
            box-shadow: 0 0 0 3px -moz-mac-focusring;
            color: #222;
            outline: none;
        }
        .select-css option {
            font-weight:normal;
        }
        
        .select_box{
            margin-right:55px;
            margin-left:55px;
        }
        
        .btn{
            border: 2px solid black;
            background-color: white;
            font-size: 18px;
            cursor: pointer;
            padding:5px;
            margin-left:20px;
        }
                              
        </style>
        
       
    </style>
</head>

<body>
    <ul class="navigation_bar">
        <li><a href="rent_home.php">HOME</a></li>
        <li><a href="">INBOX</a></li>
        <li><a href="user_book.php">BOOKING</a></li>
        <li class="float_account"><a href="nuser_profile.php">ACCOUNT</a></li>
    </ul>
    <div class="flex_box">
        <p class="title" style="postion:fixed">Select Reservation Slot</p>
    </div>
        
     
    <div class="box">
            <form method="POST" action="" class="input_name">
            <div style="overflow: auto;height:300px;">
                <table>
                  <tr>
                    <th style="height:80px"><?=$today?></th>
                    <th style="height:80px"><?php
						if ($cytd){
							echo 'Booked';
						}else{
							echo 'Empty';
						}
					?></th>
                  </tr>
                  <tr>
                    <th style="height:80px"><?=$nxt?></th>
                    <th style="height:80px"><?php
						if ($ctoday){
							echo 'Booked';
						}else{
							echo 'Empty';
						}
					?></th>
                  </tr>
                  <tr>
                    <th style="height:80px"><?=$nxtt?></th>
                    <th style="height:80px"><?php
						if ($cnxt){
							echo 'Booked';
						}else{
							echo 'Empty';
						}
					?></th>
                  </tr>

                </table>
            </div>
            <div style="display:flex; flex-direction:row; ">
                <div class="select_box">
                <p2>Day : </p2>
                <select type="varchar" name="days" class="select-css">
                <option>
                </option>
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                      <option value="6">6</option>
                                      <option value="7">7</option>
                                      <option value="8">8</option>
                                      <option value="9">9</option>
                                      <option value="10">10</option>
                                      <option value="11">11</option>
                                      <option value="12">12</option>
                                      <option value="13">13</option>
                                      <option value="14">14</option>
                                      <option value="15">15</option>
                                      <option value="16">16</option>
                                      <option value="17">17</option>
                                      <option value="18">18</option>
                                       <option value="19">19</option>
                                       <option value="20">20</option>
                                       <option value="21">21</option>
                                       <option value="22">22</option>
                                       <option value="23">23</option>
                                       <option value="24">24</option>
                                       <option value="25">25</option>
                                       <option value="26">26</option>
                </select>
                </div>

                <div class="select_box">
                <p2>Month : </p2>
                <select type="varchar" name="months" class="select-css">
                <option selected>
                </option>
                                      <option value="01">January</option>
                                      <option value="02">February</option>
                                      <option value="03">March</option>
                                      <option value="04">April</option>
                                      <option value="05">May</option>
                                      <option value="06">June</option>
                                      <option value="07">July</option>
                                      <option value="08">August</option>
                                      <option value="09">September</option>
                                      <option value="10">October</option>
                                      <option value="11">November</option>
                                      <option value="12">December</option>
                </select>

                </div>

                <div class="select_box">
                <p2>Year : </p2>
                              <select type="varchar" name="years" class="select-css">
                              <option>
                               </option>
                                     <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                              </select>
                              </div>
            </div>
            <br><br>
            <div style="display:flex; flex-direction:row; margin-left:35px; ">
                <div>
                    <input type="submit" name="submit" value="Check Availability" class="btn" style="width:150px">
                </div>
                <div>
                    <input type="submit" name="submit" value="Confirm" class="btn" style="width:70px">
                </div>
                <a href=""><button class="btn" style="color: grey; border: 2px solid grey;"><b>Cancel</b></button></a>
            </div>

            </form>
            <br><br>
    </div>


   

</body>


</html>
