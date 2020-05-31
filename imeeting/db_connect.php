<?php
define('DB_USER',"root"); //db user
define('DB_PASSWORD',""); //db password(mention your db password here)
define('DB_DATABASE', "photos"); //database name
define('DB_SERVER', "localhost"); //db server

$conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);

//check connection
if(mysqli_connect_errno()){
    echo "Failed to connect to mysql: " . mysqli_connect_error();
}

?>
