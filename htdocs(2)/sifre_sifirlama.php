<?php

session_start();
require "functions.php";
require "ayar.php";
require "getdatas.php";

$reset_err= "";

if(isLoggedin()){

  if(isset($_POST["save"])){ 
        
        $newPassword="";
        $confirmPassword="";

  
  
        if (empty(trim($_POST["password"]))) {
          $reset_err ="şifre boş";
        } else {
          $currentPassword = trim($_POST["password"]);
        }
        
        if (empty(trim($_POST["newPassword"]))) {
          $reset_err ="şifre boş";
        } elseif (strlen($_POST["newPassword"]) < 6) {
          $reset_err = "Şifre min. 6 karakter olmalıdır.";
        } else {
          $newPassword = $_POST["newPassword"];
        }
  
        if (empty(trim($_POST["confirmPassword"]))) {
          $reset_err ="şifre boş";
        } else {
          $confirmPassword = $_POST["confirmPassword"];
          if (empty($reset_err) && ($newPassword != $confirmPassword)) {
            $reset_err = "parolalar eşleşmiyor.";
          }
        }

        
        if(empty($reset_err)){
          $sql = "SELECT * from users where id=$id";
          $db_check = mysqli_query($connection,$sql);
  
          if(password_verify($currentPassword,$db_check->fetch_assoc()['password'])){
            
            $password = password_hash($newPassword, PASSWORD_DEFAULT);
  
            $fetch=$connection->query("UPDATE users SET password = '$password' WHERE id=$id");



            if($db_check){
              echo "güncellendi";
              header("location:profilduzenleme.php");
  
            }
            else{
              echo "güncelleme başarısız";
              echo '<script>alert("ELSE blogundayım")</script>';
  
            }

          }
          else{
            
            $reset_err="Mevcut şifre yanlış";
          }
           
         
  
         
        }

      


           
        }
}

?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Sporema | Şifre Sıfırlama</title>
     <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100&family=Ubuntu:wght@300&display=swap" rel="stylesheet">

   </head>
<body>
  <div class="container">
    <div class="title">Şifre Sıfırlama</div>
    <div class="content">
      <form action="sifre_sifirlama.php" method="POST" novalidate>


      <?php
    if (!empty($reset_err)) {
      echo '<div class="alert alert-danger">' . $reset_err . '</div>';
    }
    ?>

        <div class="user-details">

        <div class="input-box">
            <span for="password" class="details">Mevcut Şifre</span>
            <input type="password" name="password"  placeholder="Mevcut Şifrenizi Girin" class="form-control">

          </div>
          

          <div class="input-box">
            <span for="password" class="details">Yeni Şifre</span>
            <input type="password" name="newPassword"  placeholder="Şifrenizi Girin" class="form-control>">
          </div>
          
          <div class="input-box">
            <span for="password" class="details">Şifre Tekrar</span>
            <input type="password" name="confirmPassword"  placeholder="Şifrenizi onaylayın" class="form-control>">
          </div>

        

          <div class="button">
          <input type="submit" name="save" class="btn-primary" value="Şifremi Değiştir">
        </div>

      </form>
    </div>
  </div>

</body>
</html>

<style>
  *{
    font-family: 'Kanit', sans-serif;
    padding: 0;
    margin: 0;
    box-sizing: border-box;
   text-align: center;
   font-weight: 600;
}


a{
    text-decoration: none;
}

body{
    display: flex;
    justify-content:right;
    align-items: center;
    height: 100vh;
    padding: 10px;
    background: url(https://miro.medium.com/max/2400/1*9bGtVyWq2Yt5TNZ3oGe8Rw.jpeg);
    background-size: cover;
}

.container{
    max-width: 600px;
    width: 100%;
    height: 600px;
    background-color: #fff;
    padding: 25px 50px;
    border-radius: 15px;
    box-shadow: 0 5px 10px rgba(0,0,0,0.15);
    margin:32%;
    text-align: center;
    align-items: center;
}

.container .title{
    font-size: 30px;
    font-weight: 600;
    text-align: left;
}

.content form .user-details{

    margin: 20px 0 12px 0;
  }

  form .user-details .input-box{
    margin-top: 50px;
    width: 500px;
  }

  form .input-box span.details{
    display: block;
    font-weight: 600;
    margin-bottom: 1px;
  }

  .user-details .input-box input{
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
  cursor:pointer;
}

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



  .invalid-feedback {
    color: red;
    font-weight: bold;
    font-size: 13px;
    margin-left: -100px;
  }

  #gender-feedback {
    float: right;
  }


</style>