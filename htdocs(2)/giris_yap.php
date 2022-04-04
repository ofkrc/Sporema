<?php

ob_start();
session_start();

require "functions.php";


require "ayar.php";

$email = $password = "";
$email_err = $password_err = $login_err = "";


if (isset($_POST["login"])) {

  if (empty(trim($_POST["email"]))) {
    $email_err = "Email girmelisiniz";
  } else {
    $email = trim($_POST["email"]);
  }

  if (empty(trim($_POST["password"]))) {
    $password_err = "Şifre girmelisiniz";
  } else {
    $password = trim($_POST["password"]);
  }

  if (empty($email_err) && empty($password_err)) {
    $sql = "SELECT id, email, password FROM users WHERE email = ?";

    if ($stmt = mysqli_prepare($connection, $sql)) {
      $param_email =  $email;
      mysqli_stmt_bind_param($stmt, "s", $param_email);

      if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) == 1) {

          mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);

          if (mysqli_stmt_fetch($stmt)) {

            if (password_verify($password, $hashed_password)) {
              $_SESSION["loggedin"] = true;
              $_SESSION["id"] = $id;
              $_SESSION["email"] = $email;
              header("location: index.php");
            } else {
              $login_err = "Yanlış email ya da parola girdiniz";
            }
          }
        } else {
          $login_err = "Yanlış email ya da parola girdiniz";
        }
      } else {
        $login_err = "bilinmeyen bir hata oluştu.";
      }
      mysqli_stmt_close($stmt);
    }
  }

  mysqli_close($connection);
}

ob_end_flush();

?>



<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sporema | Giriş Yap</title>
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100&family=Ubuntu:wght@300&display=swap" rel="stylesheet" />
</head>

<body>


  <div class="container">


    <div class="errorMessage">
      <?php
      if (!empty($login_err)) {
        echo '<div class="alert alert-danger">' . $login_err . '</div>';
      }
      ?>
    </div>



    <div class="title">Giriş Yap</div>
    <div class="content">
      <form action="giris_yap.php" method="POST" novalidate>
        <div class="user-details">

          <div class="input-box">
            <span for="email" class="details">E-mail</span>
            <input type="text" name="email" id="email" placeholder="E-mail Adresinizi Girin" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : '' ?>" value="<?php echo $email; ?>">

            <div class="invalid-feedback"><?php echo $email_err; ?></div>
          </div>


          <div class="input-box">
            <span for="password" class="details">Şifre</span>
            <input type="password" name="password" id="password" placeholder="Şifrenizi Girin" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : '' ?>" value="<?php echo $password; ?>">

            <div class="invalid-feedback"><?php echo $password_err; ?></div>
          </div>

          <span class="forget">
            <a href="sifremi_unuttum.php">Şifremi Unuttum</a>
          </span>
        </div>
    </div>

    <input type="submit" name="login" value="Giriş Yap" class="btn btn-primary">


    <div class="sign-up">
      <scan>Hesabın Yok Mu ?</scan>
      <a href="kayit_ol.php" target="_blank">Üye Ol !</a>
    </div>
    </form>
  </div>
  </div>
</body>

</html>

<style>
  * {
    font-family: "Kanit", sans-serif;
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    text-align: center;
    font-weight: 600;
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

  /*container*/
  .container {
    max-width: 600px;
    width: 100%;
    height: 600px;
    background-color: #fff;
    padding: 25px 50px;
    border-radius: 15px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
    margin: 30%;
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
    margin-bottom: 15px;
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
  .user-details .input-box input:focus
  {
    border-color: purple;
    cursor: pointer;
  }

  /*buttons and selectibles*/
  .btn-primary {
    height: 45px;
    margin: 35px 0;
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

  .btn-primary:hover {
    background: linear-gradient(85deg, red, purple);
  }

  .forget {
    float: right;
  }

  .sign-up a {
    padding: 10px 20px;
    display: inline-block;
    font-size: 16px;
    margin-top: 80px;
  }

  .invalid-feedback {
    color: red;
    font-weight: bold;
    font-size: 13px;
  }

  .errorMessage {
    color: red;
  }
</style>