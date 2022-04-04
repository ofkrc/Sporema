<?php

session_start();
require "ayar.php";


$firstName = $lastName = $email = $number = $password = $confirm_password = $date = $cinsiyet = "";
$firstName_err = $lastName_err = $email_err = $number_err = $password_err = $confirm_password_err = $date_err = $cinsiyet_err = "";


if (isset($_POST["register"])) {
  // validate firstName
  if (empty(trim($_POST["firstName"]))) {
    $firstName_err = "Adınızı girmelisiniz.";
  } elseif (strlen(trim($_POST["firstName"])) < 3 or strlen(trim($_POST["firstName"])) > 25) {
    $firstName_err = "Adınız 3-25 karakter arasında olmalıdır.";
  } elseif (!preg_match('/^[a-z\d_x{ÖÇŞİĞÜöçşğüı}]{3,25}$/i', $_POST["firstName"])) {
    $firstName_err = "Adınız sadece rakam, harf ve alt çizgi karakterinden oluşmalıdır.";
  } else {
    $firstName = $_POST["firstName"];
  }

   // validate lastName
  if (empty(trim($_POST["lastName"]))) {
    $lastName_err = "Soyadınızı girmelisiniz.";
  } elseif (strlen(trim($_POST["lastName"])) < 2 or strlen(trim($_POST["lastName"])) > 20) {
    $lastName_err = "Soyadınız 2-20 karakter arasında olmalıdır.";
  } elseif (!preg_match('/^[a-z\d_x{ÖÇŞİĞÜöçşğüı}]{2,20}$/i', $_POST["lastName"])) {
    $lastName_err = "Soyadınız sadece rakam, harf ve alt çizgi karakterinden oluşmalıdır.";
  } else {
    $lastName = $_POST["lastName"];
  }

  // validate number
  if (empty(trim($_POST["number"]))) {
    $number_err = "Numaranızı girmelisiniz.";
  } elseif (strlen($_POST["number"]) != 10) {
    $number_err = "Numara 10 karakter olmalıdır.";
  }
  else {
    $number = $_POST["number"];
  }

  // validate email
  if (empty(trim($_POST["email"]))) {
    $email_err = "Email girmelisiniz.";
  } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $email_err = "Hatalı email girdiniz.";
  } else {

    $sql = "SELECT id FROM users WHERE email = ?";
    
    if ($stmt = mysqli_prepare($connection, $sql)) {
      $param_email = trim($_POST["email"]);
      mysqli_stmt_bind_param($stmt, "s", $param_email);

      if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) == 1) {
          $email_err = "Email daha önceden alınmış.";
        } else {
          $email = $_POST["email"];
        }
      } else {
        echo mysqli_error($connection);
        echo "Hata oluştu";
      }
    }
  }

  // validate password
  if (empty(trim($_POST["password"]))) {
    $password_err = "Şifre girmelisiniz.";
  } elseif (strlen($_POST["password"]) < 6) {
    $password_err = "Şifre min. 6 karakter olmalıdır.";
  } else {
    $password = $_POST["password"];
  }

  // validate confirm password
  if (empty(trim($_POST["confirm_password"]))) {
    $confirm_password_err = "Tekrar şifreyi girmelisiniz.";
  } else {
    $confirm_password = $_POST["confirm_password"];
    if (empty($password_err) && ($password != $confirm_password)) {
      $confirm_password_err = "Parolalar eşleşmiyor.";
    }
  }

  // validate date
  if (empty($_POST["dateofbirth"])) {
    $date_err = "Tarih seçmelisiniz.";
  } else {
    $date = date('Y-m-d', strtotime($_POST["dateofbirth"]));
  }
  

  //validate cinsiyet
  if (empty($_POST["cinsiyet"])) {
    $cinsiyet_err = "Cinsiyet seçmelisiniz.";
  } else {
    $cinsiyet = $_POST["cinsiyet"];
  }


  //hata oluşmadıysa ekleme sorgusuna al
  if (empty($firstName_err) && empty($lastName_err) && empty($number_err) && empty($email_err) && empty($password_err) && empty($date_err)  && empty($cinsiyet_err)) {

    $sql = "INSERT INTO users (firstName,lastName,email,number,password,date,cinsiyet) VALUES (?,?,?,?,?,?,?)";

    if ($stmt = mysqli_prepare($connection, $sql)) {

      $param_firstName = $firstName;
      $param_lastName = $lastName;
      $param_number = $number;
      $param_email = $email;
      $param_password = password_hash($password, PASSWORD_DEFAULT);
      $param_date = $date;
      $param_cinsiyet = $cinsiyet;

      mysqli_stmt_bind_param($stmt, "sssisss", $param_firstName, $param_lastName, $param_email, $param_number, $param_password, $param_date, $param_cinsiyet);
      
      if (mysqli_stmt_execute($stmt)) {
        header("location:giris_yap.php");
      } else {
        echo mysqli_error($connection);
        echo "hata oluştu";
      }
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sporema | Kayıt Ol</title>
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100&family=Ubuntu:wght@300&display=swap" rel="stylesheet" />
</head>

<body>
  <div class="container">
    <div class="title">Kayıt Ol</div>
    <div class="content">
      <form action="kayit_ol.php" method="POST" novalidate>
        <div class="user-details">

          <div class="input-box">
            <span for="firstName" class="details">Ad </span>
            <input type="text" name="firstName" id="firstName" placeholder="Adınızı Girin" class="form-control <?php echo (!empty($firstName_err)) ? 'is-invalid' : '' ?>" value="<?php echo $firstName; ?>">

            <div class="invalid-feedback"><?php echo $firstName_err; ?></div>
          </div>

          <div class="input-box">
            <span for="lastName" class="details">Soyad</span>
            <input type="text" name="lastName" id="lastName" placeholder="Soyadınızı Girin" class="form-control <?php echo (!empty($lastName_err)) ? 'is-invalid' : '' ?>" value="<?php echo $lastName; ?>">

            <div class="invalid-feedback"><?php echo  $lastName_err; ?></div>
          </div>

          <div class="input-box">
            <span for="email" class="details">E-mail</span>
            <input type="text" name="email" id="email" placeholder="E-mail Adresinizi Girin" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : '' ?>" value="<?php echo $email; ?>">

            <div class="invalid-feedback"><?php echo $email_err; ?></div>
          </div>

          <div class="input-box">
            <span for="tel" class="details">Telefon Numarası</span>
            <input type="text" name="number" id="number" placeholder="Numara : 5xx-..." class="form-control <?php echo (!empty($number_err)) ? 'is-invalid' : '' ?>" value="<?php echo $number; ?>">

            <div class="invalid-feedback"><?php echo $number_err; ?></div>
          </div>

          <div class="input-box">
            <span for="password" class="details">Şifre</span>
            <input type="password" name="password" id="password" placeholder="Şifrenizi Girin" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : '' ?>" value="<?php echo $password; ?>">

            <div class="invalid-feedback"><?php echo $password_err; ?></div>
          </div>

          <div class="input-box">
            <span for="password" class="details">Şifre Tekrar</span>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Şifrenizi onaylayın" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : '' ?>" value="<?php echo $confirm_password; ?>">

            <div class="invalid-feedback"><?php echo $confirm_password_err; ?></div>
          </div>

          <div class="input-box">
            <span for="date" class="details">Doğum Tarihinizi Giriniz</span>
            <input type="date" name="dateofbirth" id="date" class="form-control <?php echo (!empty($date_err)) ? 'is-invalid' : '' ?>" value="<?php echo $date; ?> " required>

            <div class="invalid-feedback"><?php echo $date_err; ?></div>
          </div>
        </div>

        <div class="gender-details">

          <span class="gender-title">Cinsiyet</span>

          <div class="category">

            <input type="radio" name="cinsiyet" class="radio" <?php if (isset($cinsiyet) && $cinsiyet == "erkek") echo "checked"; ?> value="erkek"> Erkek
            <input type="radio" name="cinsiyet" class="radio" <?php if (isset($cinsiyet) && $cinsiyet == "kadin") echo "checked"; ?> value="kadin"> Kadın
            <input type="radio" name="cinsiyet" class="radio" <?php if (isset($cinsiyet) && $cinsiyet == "diger") echo "checked"; ?> value="diger"> Belirtmek istemiyorum.
          </div>

        </div>
        <br>
        <?php echo (!isset($cinsiyet_err)) ? 'is-invalid' : '' ?><php?>
          <div class="invalid-feedback" id="gender-feedback"><?php echo $cinsiyet_err; ?></div>

          <input type="submit" id="register" name="register" value="Kayıt Ol" class="btn-primary">


      </form>
    </div>
  </div>
</body>

</html>

<style>
  * {
    font-family: "Kanit", sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    text-align: center;
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
    max-width: 700px;
    width: 100%;
    height: 750px;
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
    margin-bottom: 15px;
  }



  form .user-details .input-box {
    margin-bottom: 15px;
    width: 750px;
    column-count: 3;
    margin-left: -40px;
  }

  form .input-box span.details {
    display: block;
    font-weight: 600;

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
    font-weight: bolder;
    font-size: 13px;
  }

  .user-details .input-box input:hover,
  .user-details .input-box input:focus {
    border-color: purple;
    cursor: pointer;
  }

  /*cinsiyet-css*/
  form .gender-details .gender-title {
    font-size: 20px;
    font-weight: 600;
  }

  form .category {
    display: flex;
    width: 80%;
    margin-left: 60px;
    justify-content: space-between;
    font-weight: 600;
  }

  form .category .radio {
    display: flex;
    align-items: center;
    cursor: pointer;
  }

  .gender-details .radio {
    height: 18px;
    width: 18px;
    border-radius: 50%;
    margin-right: 10px;
    background: #d9d9d9;
    border: 5px solid transparent;
    transition: all 0.5s ease;
  }

  /*buttons*/
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