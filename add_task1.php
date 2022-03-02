<?php
require_once 'dbconfig.php';
session_start();

$conn = new mysqli($server, $user, $pass, $base);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$wynik = $_POST['adam'];

$pieces = explode("#", $wynik);

$sql = "INSERT INTO `calendar` (`calendar_id`, `user_id`, `description`, `progress`) VALUES (NULL, '$pieces[0]', '$pieces[1]', 'todo'); ";

if ($conn->query($sql) === TRUE) {
  echo "Zadanie dodane do bazy";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>