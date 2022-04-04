<?php

session_start();

require "ayar.php";


$reset_err = "";

if (isset($_POST["gonder"])) {

  if (empty(trim($_POST["email"]))) {
    $reset_err = "Email boş";
  } else {
    $email = trim($_POST["email"]);
  }

  if (empty($reset_err)) {

    $sql = "SELECT id, email FROM users WHERE email = ?";

    if ($stmt = mysqli_prepare($connection, $sql)) {
      $param_email =  $email;
      mysqli_stmt_bind_param($stmt, "s", $param_email);

      if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) == 1) {

          require "mail.php";
          $add_verify = "UPDATE users SET verify='$kod' where email='$email' ";
          $sonuc = mysqli_query($connection, $add_verify);

          $_SESSION["verify"] = $kod;

          header("Location:sifredegistirme.php");
        } else {
          $reset_err = "Böyle bir email adresi bulunamadı.";
        }
      } else {
        $reset_err = "Bilinmeyen bir hata oluştu.";
      }
      mysqli_stmt_close($stmt);
    }
  }
}
mysqli_close($connection);

?>



<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sporema | Şifremi Unuttum</title>
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100&family=Ubuntu:wght@300&display=swap" rel="stylesheet">

</head>

<body>
  <div class="container">
    <div class="title">Şifremi Unuttum</div>


    <div class="errorMessage">
          <?php
          if (!empty($reset_err)) {
            echo '<div class="alert alert-danger">' . $reset_err . '</div>';
          }
          ?>
        </div>

    <div class="content">
      <form action="sifremi_unuttum.php" method="POST" novalidate>
        <div class="user-details">


          <div class="input-box">
            <span class="details">E-mail</span>
            <input type="text" name="email" placeholder="E-mailinizi Girin">
          </div>

          <div class="button">
            <input type="submit" name="gonder" value="Gönder">
          </div>

          <div class="desc">Şifre yenileme linki, e-posta adresinize gönderilecektir.</div>

      </form>
    </div>
  </div>

</body>

</html>

<style>
  * {
    font-family: 'Kanit', sans-serif;
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    text-align: center;
    font-weight: 600;
  }


  a {
    text-decoration: none;
  }

  body {
    display: flex;
    justify-content: right;
    align-items: center;
    height: 100vh;
    padding: 10px;
    background: url(https://miro.medium.com/max/2400/1*9bGtVyWq2Yt5TNZ3oGe8Rw.jpeg);
    background-size: cover;
  }

  .container {
    max-width: 600px;
    width: 100%;
    height: 600px;
    background-color: #fff;
    padding: 25px 50px;
    border-radius: 15px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
    margin: 32%;
    text-align: center;
    align-items: center;
  }

  .container .title {
    font-size: 30px;
    font-weight: 600;
    text-align: left;
  }

  .content form .user-details {

    margin: 20px 0 12px 0;
  }

  form .user-details .input-box {
    margin-top: 50px;
    width: 500px;
  }

  form .input-box span.details {
    display: block;
    font-weight: 600;
    margin-bottom: 1px;
    margin-top: 80px;
  }

  .user-details .input-box input {
    height: 35px;
    width: 75%;
    outline: none;
    font-size: 15px;
    border-radius: 15px;
    padding-left: 10px;
    border: 1px solid #ccc;
    border-bottom-width: 2px;
    transition: all 0.4s ease;
    align-items: center;
  }

  .user-details .input-box input:hover,
  .user-details .input-box input:focus,
  .user-details .input-box input:valid {
    border-color: purple;
    cursor: pointer;
  }


  /*button*/

  form .button {
    height: 45px;
    margin-top: 50px;
  }

  form .button input {
    height: 100%;
    width: 100%;
    border-radius: 10px;
    border: black;
    color: #fff;
    font-size: 18px;
    font-weight: 600;
    letter-spacing: 1px;
    cursor: pointer;
    transition: all 0.3s ease;
    background: linear-gradient(135deg, #808080, #000000);
  }

  form .button input:hover {
    background: linear-gradient(85deg, red, purple);
  }

  .desc {
    margin-top: 80px;
  }

  .errorMessage {
    color: red;
    margin-top: 15px;
  }

</style>