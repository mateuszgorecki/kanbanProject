<?php
require_once 'dbconfig.php';
session_start();

$con=mysqli_connect($server, $user, $pass, $base);

if (mysqli_connect_errno()){
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$hoho = $_POST['_name'];

$result = mysqli_query($con,"SELECT * FROM users WHERE `login` = '$hoho' LIMIT 1;");

while($row = mysqli_fetch_array($result)){
 echo "<ul>";
 echo "<li class=\"user-info\"><p><strong>ID: </strong>".$row['user_id']."</p>"."</li>";
 echo "<li class=\"user-info\"><p><strong>Imię: </strong>".$row['name']."</p></li>";
 echo "<li class=\"user-info\"><p><strong>Nazwisko: </strong>".$row['surname']."</p></li>";
 echo "<li class=\"user-info\"><p><strong>Płeć: </strong>".$row['sex']."</p></li>";
 echo "<li class=\"user-info\"><p><strong>Adres email: </strong>".$row['email']."</p></li>";
 echo "<li class=\"user-info\"><p><strong>Numer telefonu: </strong>".$row['phone']."</p></li>";
 echo "</ul>";
}

mysqli_close($con);
?>