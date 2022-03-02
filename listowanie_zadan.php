<?php
require_once 'dbconfig.php';
session_start();

$con=mysqli_connect($server, $user, $pass, $base);

if (mysqli_connect_errno()){
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$hoho = $_POST['id'];

$result = mysqli_query($con,"SELECT * FROM calendar WHERE `user_id` = '$hoho';");


while($row = mysqli_fetch_array($result)){
 echo $row['progress']."/";
 echo $row['description']."/";
}

mysqli_close($con);
?>