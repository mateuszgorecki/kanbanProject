<?php
require_once '../dbconfig.php';
$username  =  $_POST['nick'];
$userpass = MD5($_POST['passHash']."ADAM_SZPITALNY");
$imie  =  $_POST['name'];
$nazwisko  =  $_POST['surname'];
$plec  =  $_POST['sex'];
$poczta  =  $_POST['email'];
$telefon  =  $_POST['phone'];

	$baza = mysqli_connect($server, $user, $pass, $base);

	$sql="select count('user_id') from users";

	$mati=mysqli_query($baza,$sql);

	$row=mysqli_fetch_array($mati);

	$zapytanie = "SELECT COUNT(1) FROM users WHERE login = '$username'";

	$result = $baza->query($zapytanie) or die ('bledne zapytanie');

	$wiersz = $result->fetch_assoc();

	$maximum = 12;

	if ($row[0] < $maximum)
	{
		if( $wiersz['COUNT(1)'] == 0){
		  $zapytanie = "INSERT INTO `users` (`user_id`, `login`, `password`, `name`, `surname`, `sex`, `email`, `phone`, `is_admin`) VALUES (NULL, '$username', '$userpass', '$imie', '$nazwisko', '$plec', '$poczta', '$telefon', 'false'); ";
		  $result = $baza->query($zapytanie) or die ('');
		  echo"Registration Complete!";
		} else
		{
		  echo"This username already exist.";
		}
	}
	else
	{
		echo "Too much users in database";
	}

	$baza->close();

?>
