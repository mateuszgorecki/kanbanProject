<!DOCTYPE html>
<?php
session_start();
?>
<html lang="pl">
<head>
<meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="author" content="Mateusz Górecki, Dawid Bucko, Adam Szpitalny, Marek Naglik" />
  <meta name="description" content="To jest mocnyProgram" />
  <title>mocnyProgram</title>

  <link rel="stylesheet" href="./css/main.css">
  <link rel="stylesheet" href="./css/form.css">

  <script type="text/javascript" src="./javascript/jq.js"></script>
  <script type="text/javascript">
    $("#logowanie").submit(function(event) {
      $("#alert").html("");
      event.preventDefault();
      var post_url = $(this).attr("action");
      var request_method = $(this).attr("method");
      var form_data = new FormData(this);

      var login = $("#login").val();
      var haslo = $("#haslo").val();

      if (/^[a-zA-Z0-9- ]*$/.test(login) == false) {
        $("#alert").html("Are you trying to hack us?");
      } else {
        form_data.append("passHash", haslo);
        var request = $.ajax({
          url: post_url,
          type: request_method,
          data: form_data,
          contentType: false,
          cache: false,
          processData: false,
        }).done(function(response) {
          $("#alert").html(response);
          $("#logowanie")[0].reset();
		  setInterval('location.reload()', 1000); 
        });
      }
    });
  </script>
</head>

<body>
  <div class="box">
    <h2>Sign into your account</h2>
    <form action="Logowanie/logowanie_go.php" method="post" id="logowanie">
      <div class="inputBox">
        <input type="text" id="login" name="login" placeholder="login" />
      </div>
      <div class="inputBox">
        <input type="password" id="haslo" name="haslo" placeholder="password" />
      </div>
      <button type="submit" class="submit button-style" value="Sign in">Sign in</button>
    </form>
    <div class="inputBox">
      <label id="alert"></label>
    </div>
  </div>

</body>

</html>