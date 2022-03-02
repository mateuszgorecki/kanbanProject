<?php
require_once 'dbconfig.php';
session_start();

$conn = new mysqli($server, $user, $pass, $base);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$wynik = $_POST['klawiatura'];

$pieces = explode("#", $wynik);

$sql = "Delete FROM `calendar` WHERE `user_id` = '$pieces[0]' AND `description` = '$pieces[1]';";

if ($conn->query($sql) === TRUE) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>