<?php
	session_start();

	if ((!isset($_SESSION['Admin'])) || ($_SESSION['Admin']=="true"))
	{
		header('Location: index.php');
		exit();
	}

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Mateusz, Dawid, Adam, Marek" />
    <meta name="description" content="To jest mocnyProgram" />
    <meta name="keywords" content="" />

    <title>Information</title>
    <link rel="stylesheet" href="./css/main.css">

<script type="text/javascript" src="./javascript/jq.js"></script>

<script type="text/javascript">
$(document).on('click', 'div.collumn', function() {
  var borowik= $(this).attr('value');
  $.ajax({
  type: 'POST',
  data: { _name: borowik},
  url: 'listowanie_danych.php',
  success: function(response) {
    $("#wynik").html(response);

  }
  });
});


</script>

</head>

<body>

  <div class="main-wrapper col-12">

    <div class="title-wrapper">
      <h1 class="title-content no-cursor">MOCNY PROGRAM</h1>
    </div>
    <div class="menu-wrapper col-12 wrapper-style">
      <a class="button-content button-style" href="user_info.php"><button type="button">Information</button></a>
      <a class="button-content button-style" href="user_tasks.php"><button type="button">Tasks</button></a>
      <a class="button-content button-style" href="Wylogowanie.php"><button type="button">Logout</button></a>
    </div>

    <div class="content-wrapper col-12">
      <div class="users-list__wrapper col-2">
        <div class="user-list__inner-wrapper wrapper-style">
          <div class="user-title">
            <h4 class="list-title no-cursor">Employee</h4>
          </div>

          <div class="user-list">
            <?php
			require_once 'dbconfig.php';

			$con=mysqli_connect($server, $user, $pass, $base);

			if (mysqli_connect_errno()){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}

			$result = mysqli_query($con,"SELECT * FROM users LIMIT 1");

			while($kolumna = mysqli_fetch_array($result)){
			echo "<div class='collumn button-style' value='".$_SESSION['login']."'>".$_SESSION['login']."</div>";
			}
			mysqli_close($con);
		?>
          </div>
        </div>
      </div>

      <div class="user-info__wrapper col-10">
        <div class="user-info__inner-wrapper wrapper-style">
          <div class="user-title">
            <h4 class="info-title no-cursor">Information</h4>
          </div>

          <div class="user-list__content no-cursor" id="wynik">
          </div>

        </div>
      </div>
    </div>
  </div>

  </div>

  <script type="text/javascript" src="./javascript/animation.js"></script>
</body>

</html>