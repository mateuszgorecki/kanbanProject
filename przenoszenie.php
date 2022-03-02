<?php
require_once 'dbconfig.php';
session_start();

$conn = new mysqli($server, $user, $pass, $base);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$wynik = $_POST['klocek'];

echo $wynik;

$pieces = explode("#", $wynik);

$sql = "UPDATE `calendar` SET `progress`='$pieces[2]' WHERE `user_id` = '$pieces[0]' AND `description` = '$pieces[1]';";

if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>