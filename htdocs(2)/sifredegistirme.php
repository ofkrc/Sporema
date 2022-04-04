<?php

session_start();
require "functions.php";
require "ayar.php";


$reset_err = "";



if (isset($_POST["forget"])) {

  $newPassword = "";
  $confirmPassword = "";
  $verify = "";


  if (empty(trim($_POST["verify"]))) {
    $reset_err = "Lütfen tüm değerleri doldurunuz.";
  } else {
    $verify = trim($_POST["verify"]);
  }

  if (empty(trim($_POST["newPassword"]))) {
    $reset_err = "Lütfen tüm değerleri doldurunuz.";
  } elseif (strlen($_POST["newPassword"]) < 6) {
    $reset_err = "Şifre min. 6 karakter olmalıdır.";
  } else {
    $newPassword = $_POST["newPassword"];
  }

  if (empty(trim($_POST["confirmPassword"]))) {
    $reset_err = "Lütfen tüm değerleri doldurunuz.";
  } else {
    $confirmPassword = $_POST["confirmPassword"];
    if (empty($reset_err) && ($newPassword != $confirmPassword)) {
      $reset_err = "Parolalar eşleşmiyor.";
    }
  }

  if (empty($reset_err)) {

    if ($verify == $_SESSION["verify"]) {

      $sql = "SELECT * from users where verify='$verify'";
      $db_check = mysqli_query($connection, $sql);

      $password = password_hash($newPassword, PASSWORD_DEFAULT);

      $fetch = $connection->query("UPDATE users SET password = '$password' WHERE verify='$verify'");

      if ($db_check) {

        header("location:giris_yap.php");
      } else {
        echo "Güncelleme başarısız";
      }
    } else {
      $reset_err = "Değerler eşleşmiyor";
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
    <div class="content">
      <form action="sifredegistirme.php" method="POST" novalidate>


        <div class="errorMessage">
          <?php
          if (!empty($reset_err)) {
            echo '<div class="alert alert-danger">' . $reset_err . '</div>';
          }
          ?>
        </div>




        <div class="user-details">
          <div class="input-box">
            <span class="details">Doğrulama Kodu</span>
            <input type="text" placeholder="E-mailinizi Girin" name="verify" class="form-control" value= >
          </div>

          <div class="input-box">
            <span class="details">Yeni Şifre</span>
            <input type="password" placeholder="Şifrenizi Girin" name="newPassword" class="form-control">
          </div>

          <div class="input-box">
            <span class="details">Şifre Onay</span>
            <input type="password" placeholder="Şifrenizi Onaylayın" name="confirmPassword" class="form-control">
          </div>
        </div>

        <div class="button">
          <input type="submit" name="forget" value="Şifremi Değiştir">
        </div>

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

  .errorMessage {
    color: red;
    margin-top: 15px;
  }
</style>