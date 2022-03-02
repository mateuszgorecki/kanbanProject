<!DOCTYPE html>
<html lang="pl">
<html>
<?php
session_start();

error_reporting(0);

if ((isset($_SESSION['Admin'])) && ($_SESSION['Admin'] == "true")) {
    header('Location: user_info_admin.php');
    exit();
  }
elseif ((isset($_SESSION['Admin'])) && ($_SESSION['Admin'] == "false")) {
  header('Location: user_info.php');
  exit();
}

?>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="author" content="Mateusz, Dawid, Adam, Marek" />
  <meta name="description" content="To jest mocnyProgram" />
  <title>mocnyProgram</title>

  <link rel="stylesheet" href="./css/main.css">

  <script type="text/javascript" src="./javascript/jq.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $(document).on('click', 'a', function() {
        var x = $(this).attr("co");
        $("#menu").load(x);
      });
    });
    </script>
  <script>
    $(document).ready(function() {
      $("#men").ready(function() {
        $.ajax({
          type: 'POST',
          url: 'index_menu.php',
          success: function(response) {
            $("#men").html(response);
          }
        });
      });
    });

	window.onload = function()
	{
	document.getElementById('btn').click();

	var scriptTag = document.createElement("script");
	scriptTag.src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js";
	document.getElementsByTagName("head")[0].appendChild(scriptTag);
	}
    </script>
</head>

<body>
  <div class="form-wrapper">
    <div class="inner-wrapper wrapper-style">
      <div id="men"></div>
      <div id="menu"></div>
    </div>
  </div>
  <a href="https://www.vecteezy.com/free-vector/abstract-background">Abstract Background Vectors by Vecteezy</a>
</body>

</html>