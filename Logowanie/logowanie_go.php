<?php
require_once '../dbconfig.php';
session_start();
$username  =  $_POST['login'];
$userpass = $_POST['haslo'];

$baza = mysqli_connect($server, $user, $pass, $base);

$zapytanie = "SELECT COUNT(1) FROM users WHERE login = '$username'";

$result = $baza->query($zapytanie) or die ('cos nie dziala');

$wiersz = $result->fetch_assoc();
	if( $wiersz['COUNT(1)'] == '1'){

		$MD5 = MD5($userpass."admin");

		$zapytanie = "SELECT * FROM users WHERE login = '$username'";

		$result = $baza->query($zapytanie) or die ('bledne zapytanie');

		$wiersz = $result->fetch_assoc();

			if( $wiersz['password'] == $MD5){
				$_SESSION['login'] = $wiersz['login'];
				$_SESSION['user_id'] = $wiersz['user_id'];
				$_SESSION['Admin'] = $wiersz['is_admin'];
				$_SESSION['online'] = true;
				echo "Welcome ".$_SESSION['login']."! Good to see you again!";
				header("Refresh:1; url=index_menu.php");
			}

			else{
				echo "Invalid Password";

			}

	}
	else{
		echo "Invalid Login";
	}

$baza->close();

?>
