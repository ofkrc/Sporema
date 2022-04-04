<?php


session_start();

require "functions.php";
require "ayar.php";
require "getdatas.php";


$name_err = $surname_err = $mail_err = $tel_err = $age_err = $identity_err = "";





if (isLoggedin()) {

  if (isset($_POST["save"])) {

    $name = $_SESSION['firstName'];
    $surname = $_SESSION['lastName'];
    $mail = $_SESSION['email'];
    $tel = $_SESSION['number'];
    $age = $_SESSION['date'];
    $identity = $_SESSION['tc'];


    if (empty(trim($_POST["firstName"]))) {
      $name_err = "Adınızı girmelisiniz.";
    } elseif (strlen(trim($_POST["firstName"])) < 3 or strlen(trim($_POST["firstName"])) > 25) {
      $name_err = "Adınız 3-25 karakter arasında olmalıdır.";
    } elseif (!preg_match('/^[a-z\d_x{ÖÇŞİĞÜöçşğüı}]{3,25}$/i', $_POST["firstName"])) {
      $name_err = "Adınız sadece rakam, harf ve alt çizgi karakterinden oluşmalıdır.";
    } else {
      $name = $_POST["firstName"];
    }
  
    if (empty(trim($_POST["lastName"]))) {
      $surname_err = "Soyadınızı girmelisiniz.";
    } elseif (strlen(trim($_POST["lastName"])) < 2 or strlen(trim($_POST["lastName"])) > 20) {
      $surname_err = "Soyadınız 2-20 karakter arasında olmalıdır.";
    } elseif (!preg_match('/^[a-z\d_x{ÖÇŞİĞÜöçşğüı}]{3,25}$/i', $_POST["lastName"])) {
      $surname_err = "Soyadınız sadece rakam, harf ve alt çizgi karakterinden oluşmalıdır.";
    } else {
      $surname = $_POST["lastName"];
    }

    //email
    if (trim($_POST['email']) != $_SESSION["email"]) {
      $mail_err = "Email değiştiremezsiniz.";
    }

    if (empty(trim($_POST["number"]))) {
      $tel_err = "Numaranızı girmelisiniz.";
    } elseif (strlen($_POST["number"]) != 10 ) {
      $tel_err = "Numara 12 karakter olmalıdır.";
    } else{
      $tel = $_POST["number"];
    }

    if (empty(trim($_POST['date']))) {
      $age_err =  "Tarih girmelisiniz";
    } else {
      $age = trim($_POST["date"]);
    }


    if (!empty(trim($_POST["tc"]))) {
      if (strlen($_POST["tc"]) !=11 ) {
        $identity_err = "TC Kimlik Numarası 11 haneli olmalıdır.";
      }
       else {
        $identity = $_POST["tc"];
      }
    }
    


    $identity = trim($_POST['tc']);

    if(empty($name_err) && empty($surname_err) && empty($mail_err) && empty($age_err) && empty($identity_err)){
      $sorgu = "UPDATE users SET firstName='$name',lastName='$surname',email='$mail',number=$tel,date='$age',tc='$identity' where id=$_SESSION[id] ";
      $sonuc = mysqli_query($connection, $sorgu);
  
      if ($sonuc) {
  
        echo "<p style='color:white;margin-bottom:-24px;background-color:#DD4453;'>" . "Güncellendi" . "</p><br>";
      } else {
        echo "<p style='color:white;background-color:#DD4453;'>" . "Güncelleme başarısız" . "</p><br>";
      }
    }

   
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sporema | Profil Düzenleme</title>
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100&family=Ubuntu:wght@300&display=swap" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/a6e0102296.js" crossorigin="anonymous"></script>
</head>

<body>

  <?php require "navbar.php"; ?>



  <div class="container">
    <div class="title">Profil Ayarları</div>
    <div class="content">
      <form action="profilduzenleme.php" method="POST" novalidate>
        <div class="photo-box">
          <i class="fas fa-user-alt"></i>
        </div>

        <div class="logout">
          <a href="logout.php">Çıkış Yap</a>
        </div>

        <div class="button1">
          <a href="sifre_sifirlama.php">Şifre Sıfırlama</a>
        </div>
        <div class="user-details">
          <div class="input-box">
            <span class="details">Adı</span>
            <input type="text" name="firstName" placeholder="Adınız" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : '' ?>" value="<?php echo $_SESSION["firstName"] ?>" />
            <div class="invalid-feedback"><?php echo $name_err; ?></div>
          </div>
          <div class="input-box">
            <span class="details">Soyad</span>
            <input type="text" name="lastName" placeholder="Soyadınızı Girin" class="form-control <?php echo (!empty($surname_err)) ? 'is-invalid' : '' ?>" value="<?php echo $_SESSION["lastName"] ?>" />
            <div class="invalid-feedback"><?php echo $surname_err; ?></div>
          </div>
          <div class="input-box">
            <span class="details">E-mail</span>
            <input type="text" name="email" placeholder="E-mail Adresinizi Girin" class="form-control <?php echo (!empty($mail_err)) ? 'is-invalid' : '' ?>" value="<?php echo $_SESSION["email"] ?>" />
            <div class="invalid-feedback"><?php echo $mail_err; ?></div>
          </div>
          <div class="input-box">
            <span class="details">TC Kimlik Numarası</span>
            <input type="number" name="tc" placeholder="TC Kimlik Numaranızı Girin"  class="form-control <?php echo (!empty($identity_err)) ? 'is-invalid' : '' ?>" value="<?php echo $_SESSION["tc"] ?>" />
            <div class="invalid-feedback"><?php echo $identity_err; ?></div>
          </div>
          <div class="input-box">
            <span class="details">Telefon Numarası</span>
            <input type="tel" name="number" placeholder="Numaranızı Girin" class="form-control <?php echo (!empty($tel_err)) ? 'is-invalid' : '' ?>" value="<?php echo $_SESSION["number"] ?>" />
            <div class="invalid-feedback"><?php echo $tel_err; ?></div>
          </div>
          <div class="input-box">
            <span class="details">Doğum Tarihinizi Giriniz</span>
            <input type="date" name="date" class="form-control <?php echo (!empty($age_err)) ? 'is-invalid' : '' ?>" value="<?php echo $_SESSION["date"] ?>" />
            <div class="invalid-feedback"><?php echo $age_err; ?></div>
          </div>
          <div class="input-box">
            <span class="details">Katılma Tarihi</span>
            <br>
            <br>
            <span style="color:black">
              <input type="text" value="<?php echo $_SESSION["reg_date"] ?>" readonly>
            </span>
          </div>
        </div>

        <div class="button1">
          <input type="submit" name="save" value="Onayla" class="btn btn-primary" />
        </div>

        <div class="title">Üyelik Silme</div>
        <div class="button1">
          <a href="uyeliksilme.php">Üyelik Silme</a>
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
  }

  body {
    background-color: black;
    color: white;
  }

  /*container*/
  .container {
    max-width: 1100px;
    width: 100%;
    height: 650px;
    background-color: #fff;
    padding: 15px;
    border-radius: 15px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
    border: 1px solid;
    column-count: 2;
    column-rule: 2px solid black;
    column-gap: 25px;
    margin-top: 8px;
  }

  .photo-box .fa-user-alt {
    color: grey;
    float: left;
    font-size: 100px;
    padding: 20px;
    border: 2px solid grey;
    border-radius: 50%;
    margin-top: 80px;
    margin-bottom: 18px;
  }

  .container .title {
    font-size: 30px;
    font-weight: 600;
    text-align: left;
    float: left;
    padding: 15px;
    margin-bottom: 25px;
    color: black;
  }

  .content form .user-details {
    margin: 10px;
    position: inherit;
  }

  form .user-details .input-box {
    margin-bottom: 20px;
    width: 200px;
  }

  form .input-box span.details {
    display: block;
    font-weight: 600;
    margin-bottom: 1px;
    float: left;
    color: black;
  }

  .user-details .input-box input {
    height: 35px;
    width: 150%;
    outline: none;
    font-size: 15px;
    border-radius: 15px;
    padding-left: 10px;
    border: 1px solid #ccc;
    border-bottom-width: 2px;
    transition: all 0.4s ease;
    align-items: center;
  }

  .button1 a {
    text-decoration: none;
    margin-bottom: 50px;
    float: left;
    padding: 5px;
    color: white;
  }

  textarea {
    border-radius: 10px;
  }

  .user-details .input-box input:hover,
  .user-details .input-box input:focus {
    border-color: purple;
    cursor: pointer;
  }

  form .button1,
  a {
    height: 45px;
    margin-top: 20px;
  }

  form .button1 input,
  .button1 a {
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

  form .button1 input:hover,
  .button1 a:hover {
    background: linear-gradient(85deg, red, purple);
  }

  .invalid-feedback {
    color: red;
    font-weight: bold;
    font-size: 13px;
  }
</style>