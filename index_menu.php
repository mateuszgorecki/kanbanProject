<?php
session_start();
if (isset($_SESSION['online']) == false || $_SESSION['online'] == false) { ?>
  <!DOCTYPE html>
  <html lang="pl">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Mateusz, Dawid, Adam, Marek" />
    <meta name="description" content="To jest mocnyProgram" />
    <title>Mocny Program</title>

    <link rel="stylesheet" href="./css/main.css">
  </head>

  <body>

    <div class="button-wrapper">
      <a href="#" class="online button-style" co="Rejestracja/rejestracja.php"><button type="button">Create a new account</button></a>
      <a href="#" class="online button-style" co="Logowanie/logowanie.php"><button type="button" id="btn" onclick="test()">Sign in</button></a>
    </div>


  <?php } elseif ((isset($_SESSION['Admin'])) && ($_SESSION['Admin'] == "false")) {
  header('Location: user_info.php');
  exit();
}
  ?>
  <?PHP
  if ((isset($_SESSION['Admin'])) && ($_SESSION['Admin'] == "true")) {
    header('Location: user_info_admin.php');
    exit();
  }
  ?>
  </body>

  </html>