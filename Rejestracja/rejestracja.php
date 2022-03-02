<!DOCTYPE html>
<?php
session_start();
?>
<html lang="pl">

<head>

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="author" content="Mateusz, Dawid, Adam, Marek " />
  <meta name="description" content="To jest mocnyProgram" />
  <title>mocnyProgram</title>

  <link rel="stylesheet" href="./css/main.css">
  <link rel="stylesheet" href="./css/form.css">

  <script type="text/javascript" src="./javascript/jq.js"></script>

  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <script type="text/javascript">
    function timestamp() {
      var response = document.getElementById("g-recaptcha-response");
      if (response == null || response.value.trim() == "") {
        var elems = JSON.parse(document.getElementsByName("captcha_settings")[0].value);
        elems["ts"] = JSON.stringify(new Date().getTime());
        document.getElementsByName("captcha_settings")[0].value = JSON.stringify(elems);
      }
    }
    setInterval(timestamp, 500000);
  </script>
  <script type="text/javascript">
    function recaptcha_callback() {
      $('.button').prop("disabled", false);
    }

    $(document).bind("contextmenu", function(e) {
      e.preventDefault();
    });


    $("#register").submit(function(event) {
      $("#alert").html("");
      event.preventDefault();
      var post_url = $(this).attr("action");
      var request_method = $(this).attr("method");
      var form_data = new FormData(this);

      var p1 = $("#pass1").val();
      var p2 = $("#pass2").val();
      var nick = $("#nick").val();
      var name = $("#name").val();
      var surname = $("#surname").val();
      var sex = $("#sex").val();
      var email = $("#email").val();
      var phone = $("#phone").val();
      if (p1 != p2) {
        $("#alert").html("Passwords are not the same.");
      } else if (/^[a-zA-Z0-9- ]*$/.test(nick) == false) {
        $("#alert").html("Invalid Username");
      } else if (/^[a-zA-Z0-9-  ą,ć,ę,ś,ź,ż,ó,ń,ł ]*$/.test(name) == false) {
        $("#alert").html("Write your name properly");
      } else if (/^[a-zA-Z0-9-  ą,ć,ę,ś,ź,ż,ó,ń,ł ]*$/.test(surname) == false) {
        $("#alert").html("Write your surname properly");
      } else {

        form_data.append("passHash", p1);

        var request = $.ajax({
          url: post_url,
          type: request_method,
          data: form_data,
          contentType: false,
          cache: false,
          processData: false,
        }).done(function(response) {
          $("#alert").html(response);
          $("#register")[0].reset();
        });
      }

    });
  </script>
</head>

<body>

  <div class="box">
    <form method="post" id="register" action="Rejestracja/rejestracja_go.php">
      <div class="inputBox">
        <input type="text" id="nick" name="nick" placeholder="Username" required />
      </div>

      <div class="inputBox">
        <input type="password" id="pass1" name="haslo1" placeholder="Password" required />
      </div>
      <div class="inputBox">
        <input type="password" id="pass2" name="haslo2" placeholder="Repeat password" required />
      </div>

      <div class="inputBox">
        <input type="text" id="name" name="name" maxlength="50" placeholder="Name" required />
      </div>

      <div class="inputBox">
        <input type="text" id="surname" name="surname" placeholder="Surname" maxlength="50" required />
      </div>

      <div class="inputBox">
        <select name="sex" id="sex" aria-placeholder="choose gender">
          <option value="male">Male</option>
          <option value="female">Female</option>
          <option value="unisex">Prefer not to tell</option>
        </select>
      </div>

      <div class="inputBox">
        <input type="email" id="email" name="email" placeholder="E-mail" required />
      </div>

      <div class="inputBox">
        <input type="number" id="phone" name="phone" placeholder="Phone number" required />
      </div>

      <div class="g-recaptcha" data-sitekey="6Lfib6EaAAAAABPXJK3MYoX10wuXRHK6ma30g0SU" data-callback="recaptcha_callback">
  </div>

      <div class="buttons">
      <button type="reset" class="button-style " value="Reset">Reset</button>
      <button type="submit " value="Continue" disabled="true" class="button button-style submit">Continue</button>
      </div>
    </form>
    <div class="inputBox">
      <label id="alert"></label>
    </div>
  </div>

</body>

</html>