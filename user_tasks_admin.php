<?php
session_start();

if ((!isset($_SESSION['Admin'])) || ($_SESSION['Admin'] == "false"))
{
  header('Location: index.php');
  exit();
}

?>
<!DOCTYPE html>
<html lang="pl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="author" content="Mateusz, Dawid, Adam, Marek" />
  <meta name="description" content="To jest mocnyProgram" />
  <meta name="keywords" content="" />

  <title>Information</title>
  <link rel="stylesheet" href="./css/kanban.css">
  <link rel="stylesheet" href="./css/main.css">
  <link rel="stylesheet" href="./css/form.css">

  <script src="./javascript/jq.js"></script>
  <script type="module" src="./javascript/user.js"> </script>

  <script type="text/javascript">
    $(document).on('click', '#add-task', function() {
      var prawdziwek = $('#desc').text();
      $.ajax({
        type: 'POST',
        data: {
          adam: prawdziwek
        },
        url: 'add_task1.php',
        success: function(response) {
          console.log(response);
        }
      });
    });

	$(document).on('click', '#yes', function() {
      var razer = $('#desc').text();
      $.ajax({
        type: 'POST',
        data: {
          klawiatura: razer
        },
        url: 'usuwanie.php',
        success: function(response) {
          console.log(response);
        }
      });
    });

	$(document).on('click', '.heading-title', function() {

	var sTimeOut = setTimeout(function ()
		{
		var LEGO = $('#desc').text();

		  $.ajax({
			type: 'POST',
			data: {
			  klocek: LEGO
			},
			url: 'przenoszenie.php',
			success: function(response) {
			  console.log(response);
			}
		  });
		}, 100);
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
            <h4 class="list-title no-cursor">Employees</h4>
          </div>

          <div class="user-list ">
            <?php
            require_once 'dbconfig.php';

            $con = mysqli_connect($server, $user, $pass, $base);

            if (mysqli_connect_errno()) {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }

            $result = mysqli_query($con, "SELECT * FROM users");

            while ($kolumna = mysqli_fetch_array($result)) {
              echo "<div class='collumn button-style' id='user' value='" . $kolumna['user_id'] . "'>" . $kolumna['login'] . "</div>";
            }
            mysqli_close($con);
            ?>
          </div>
        </div>
      </div>

      <div class="user-info__wrapper col-10">
        <div class="user-info__inner-wrapper wrapper-style">
          <div class="user-title">
            <h2 class="info-title no-cursor">Information</h2>
          </div>

          <div class="user-list__content no-cursor" id="wynik">

            <div id="kanban-container" class="kanban-container">
              <div class="kanban-column">
                <div class="column-title">
                  <h4 class='heading-title'>todo</h4>
                </div>

                <div class="column-content">
                  <ul class="todo" id="todo"></ul>
                </div>
              </div>

              <div class="kanban-column">
                <div class="column-title">
                  <h4 class='heading-title'>in progress</h4>
                </div>

                <div class="column-content">
                  <ul class="in-progress" id="in-progress"></ul>
                </div>
              </div>

              <div class="kanban-column">
                <div class="column-title">
                  <h4 class='heading-title'>done</h4>
                </div>

                <div class="column-content">
                  <ul class="done" id="done"></ul>
                </div>
              </div>
            </div>

            <div class="column-button">
              <a href="#" class="just-button button-style" id="add-task"><button type="button">Add task to DB</button></a>
              <a href="#" class="just-button button-style" id="todo-button"><button type="button">Add Task</button></a>
            </div>

          </div>

        </div>
      </div>
    </div>
  </div>

  <div id="delete-task" class="modal">
    <div class="modal-content wrapper-style">
      <h4>Are you sure?</h4>
      <span class="close">&times;</span>
      <div>
        <button type="button" class="submit btn-modal" id="yes">Yes</button>
        <button type="button" class="submit btn-modal" id="no">No</button>
      </div>
    </div>
    <span id="desc"></span>
  </div>

  <div id="myModal" class="modal">
    <div class="modal-content wrapper-style">
      <span class="close">&times;</span>
      <div>
        <form>
          <input type="text" id="description" maxlength="30" placeholder="Add description of new task...">
          <button type="submit" class="submit button-style" id="send-task">Add</button>
        </form>

      </div>
    </div>
    <span id="desc"></span>
  </div>
  </div>
  <script type="module" src="./javascript/kanban.js"></script>
  <script type="text/javascript" src="./javascript/animation.js"></script>
</body>

</html>