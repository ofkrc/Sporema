<?php

session_start();
require "ayar.php";
require "functions.php";

$tesisAd = $turId = $tesisUcret  = $calismasaatiId = $sehirId = $detay= $ozellikId= $fotografId= "";
$tesisAd_err = $turId_err = $tesisUcret_err = $calismasaatiId_err = $sehirId_err = $detay_err = $ozellikId_err=$fotografId_err="";


if (isset($_POST["tesisekle"])) {


  $id= $_SESSION['id'];  

  // validate username
  if (empty(trim($_POST["tesisAd"]))) {
    $tesisAd_err = "tesisAd girmelisiniz.";
  } elseif (strlen(trim($_POST["tesisAd"])) < 3 or strlen(trim($_POST["tesisAd"])) > 55) {
    $tesisAd_err = "Tesis Adı 3-55 karakter arasında olmalıdır.";
  } else {
    $tesisAd = $_POST["tesisAd"];
  }


  // validate tesisUcret
  if (empty(trim($_POST["tesisUcret"]))) {
    $tesisUcret_err = "Ücreti girmelisiniz.";
  } elseif (strlen($_POST["tesisUcret"]) < 0 || strlen($_POST["tesisUcret"]) > 10) {
    $tesisUcret_err = "Ücret pozitif olmalıdır";
  } elseif (strlen($_POST["tesisUcret"])> 0) {
    $tesisUcret = $_POST["tesisUcret"]."TL";
  }


  // validate date

  if (empty($_POST["calismasaatiId"])) {
    $calismasaatiId_err = "Tarih seçmelisiniz.";
  } else {
    $calismasaatiId = $_POST["calismasaatiId"];
  }



  //validate gender

  if (empty($_POST["sehirId"])) {
    $sehirId_err = "Şehir seçmelisiniz.";
  } else {
    $sehirId = $_POST["sehirId"];
  }


  
  if (empty($_POST["turId"])) {
    $turId_err = "Tür seçmelisiniz.";
  } else {
    $turId = $_POST["turId"];
  }


  if (empty($_POST["ozellikId"])) {
    $ozellikId_err = "Özellik seçmelisiniz.";
  } else {
    $ozellikId = $_POST["ozellikId"];
  }


  if (empty(trim($_POST["detay"]))) {
    $detay_err = "detay girmelisiniz.";
  } elseif (strlen(trim($_POST["detay"])) < 10 or strlen(trim($_POST["detay"])) > 100) {
    $detay_err = "Açıklama 3-55 karakter arasında olmalıdır.";
  }  else {
    $detay = $_POST["detay"];
  }


  if (empty($_FILES["fotografId"]["name"])) {
    $fotografId_err = "dosya seçiniz";
} else {
    $result = saveImage($_FILES["fotografId"]);

    if($result["isSuccess"] == 0) {
        $fotografId_err = $result["message"];
    } else {
        $fotografId = $result["image"];
    }
}
  
  
$user_id = $_SESSION["id"];
$_SESSION["user_id"] = $user_id;



  if (empty($tesisAd_err) && empty($tesisUcret_err) && empty($sehirId_err) && empty($turId_err) && empty($ozellikId_err) && empty($calismasaatiId_err) && empty($fotografId_err)) {

    $sql = "INSERT INTO tesistable (tesisAd,tesisUcret,sehirId,turId,ozellikId,calismasaatiId,detay,fotografId,user_id) VALUES (?,?,?,?,?,?,?,?,?)";

    if ($stmt = mysqli_prepare($connection, $sql)) {

      $param_tesisAd = $tesisAd;
      $param_tesisUcret = $tesisUcret;
      $param_sehirId = $sehirId;
      $param_turId = $turId;
      $param_ozellikId = $ozellikId;
    
      $param_calismasaatiId = $calismasaatiId;
      $param_detay = $detay;
      $param_fotografId= $fotografId;
      $param_user_id = $user_id;
      

      mysqli_stmt_bind_param($stmt, "sisssssss", $param_tesisAd, $param_tesisUcret, $param_sehirId, $param_turId,  $param_ozellikId,  $param_calismasaatiId, $param_detay, $param_fotografId ,$param_user_id );

      if (mysqli_stmt_execute($stmt)) {
        header("location: tesissilme.php");
      } else {
        echo mysqli_error($connection);
        echo "hata oluştu";
      }
    }
  }
}

?>












<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tesis Ekleme</title>
    <link rel="stylesheet" href="tesisekleme.css";>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    
</head>
<body>
    <div class="container">
        <div class="title">
            <h1>Tesis Ekleme Arayüzü</h1>
        </div><br><br>
        <div class="content">
        <form action="tesisekleme.php" method="POST" enctype="multipart/form-data" novalidate>  
                <div class="input-box">
                    <span class="details">Tesis Adı</span>
                    <input type="text" name="tesisAd" placeholder="Tesis Adı Girin" class="form-control  <?php echo (!empty($tesisAd_err)) ? 'is-invalid' : '' ?>" value="<?php echo $tesisAd; ?>">
                    <div class="invalid-feedback"><?php echo $tesisAd_err; ?></div>
                    </div>   
                    <div class="input-box"><br>
                    <span class="details">Ücreti</span>
                    <input type="number" name="tesisUcret" placeholder="Tesis Ücreti Girin (₺)" class="form-control <?php echo (!empty($tesisUcret_err)) ? 'is-invalid' : '' ?>" value="<?php echo $tesisUcret; ?>">
                    <div class="invalid-feedback"><?php echo $tesisUcret_err; ?></div>  
                
                <div class="tesissehir"> <br>
                    <span class="details">Tesisin bulunduğu şehri seçiniz</span>
                    <input type="radio" name="sehirId" class="sehir" <?php if (isset($sehirId) && $sehirId == "Istanbul") echo "checked"; ?> value="Istanbul" >
                    <label for="istanbul">İstanbul</label>
                    <input type="radio" name="sehirId" class="sehir"  <?php if (isset($sehirId) && $sehirId == "Ankara") echo "checked"; ?> value="Ankara"  >
                    <label for="Ankara">Ankara</label>
                    <input type="radio" name="sehirId" class="sehir"  <?php if (isset($sehirId) && $sehirId == "Isparta") echo "checked"; ?> value="Isparta"  >
                    <label for="Isparta">Isparta</label>
                </div>   
                
                <?php echo (!isset($sehirId_err)) ? 'is-invalid' : '' ?><php?>
                <div class="invalid-feedback" id="sehirId-feedback"><?php echo $sehirId_err; ?></div>
                
                <div class="input-box" name="tesis-turu"><br>
                    <span class="details">Tesis türü seçiniz</span>
                    <input type="radio" name="turId" class="tur" <?php if (isset($turId) && $turId == "Fitness") echo "checked"; ?> value="Fitness"   >
                    <label for="fitness">Fitness</label>
                    <input type="radio" name="turId" class="tur" <?php if (isset($turId) && $turId == "Futbol") echo "checked"; ?> value="Futbol" >
                    <label for="futbol">Futbol</label>
                    <input type="radio" name="turId" class="tur" <?php if (isset($turId) && $turId == "Basketbol") echo "checked"; ?> value="Basketbol"  >
                    <label for="basketbol">Basketbol</label>

                    <?php echo (!isset($turId_err)) ? 'is-invalid' : '' ?><php?>
                     <div class="invalid-feedback" id="turId-feedback"><?php echo $turId_err; ?></div>
                    
                </div>
                <div class="input-box" id="tesis-ozellikleri">
                    <span class="details" name="yazilar">Tesis özelliklerini seçiniz</span>
                    <input type="checkbox" id="wifi" name="ozellikId" <?php if (isset($ozellikId) && $ozellikId == "Wifi") echo "checked"; ?> value="Wifi" >
                    <label for="wifi"> Wifi</label>
                    <input type="checkbox" id="kredi" name="ozellikId" <?php if (isset($ozellikId) && $ozellikId == "Kredi") echo "checked"; ?> value="Kredi" >
                    <label for="kredi"> Kredi Kartı</label>
                    <input type="checkbox" id="dus" name="ozellikId" <?php if (isset($ozellikId) && $ozellikId == "Dus") echo "checked"; ?> value="Dus" >
                    <label for="dus"> Duş</label>
                    <input type="checkbox" id="yemek" name="ozellikId" <?php if (isset($ozellikId) && $ozellikId == "Yemek") echo "checked"; ?> value="Yemek"  >
                    <label for="yemek"> Yemek</label>
                    <input type="checkbox" id="wc" name="ozellikId" <?php if (isset($ozellikId) && $ozellikId == "Wc") echo "checked"; ?> value="Wc" >
                    <label for="wc"> Tuvalet</label>
                    <input type="checkbox" id="otopark" name="ozellikId"  <?php if (isset($ozellikId) && $ozellikId == "Otopark") echo "checked"; ?> value="Otopark" >
                    <label for="otopark"> Otopark</label>
                    <input type="checkbox" id="mescit" name="ozellikId"  <?php if (isset($ozellikId) && $ozellikId == "Mescit") echo "checked"; ?> value="Mescit" >
                    <label for="mescit"> Mescit</label>
                    
                </div>

                <?php echo (!isset($ozellikId_err)) ? 'is-invalid' : '' ?><php?>
                     <div class="invalid-feedback" id="ozellikId-feedback"><?php echo $ozellikId_err; ?></div>

                <div class="input-box" name="tesis-calisma-saatleri">
                    <span class="details">Tesis çalışma saatlerini seçiniz</span>
                    <input type="checkbox" class="saat" id="09:00-10:00" <?php if (isset($calismasaatiId) && $calismasaatiId == "calismasaatiId") echo "checked"; ?> name="calismasaatiId" value="09:00 10:00">
                    <label for="09:00-10:00"> 09:00-10:00</label>
                    <input type="checkbox" class="saat" id="10:00-11:00" <?php if (isset($calismasaatiId) && $calismasaatiId == "calismasaatiId") echo "checked"; ?> name="calismasaatiId" value="10:00-11:00"> 
                    <label for="10:00-11:00"> 10:00-11:00</label>
                    <input type="checkbox"class="saat" id="11:00-12:00" <?php if (isset($calismasaatiId) && $calismasaatiId == "calismasaatiId") echo "checked"; ?> name="calismasaatiId" value="11:00-12:00"> 
                    <label for="11:00-12:00"> 11:00-12:00</label>
                    <input type="checkbox" class="saat"id="12:00-13:00" <?php if (isset($calismasaatiId) && $calismasaatiId == "calismasaatiId") echo "checked"; ?> name="calismasaatiId" value="12:00-13:00"> 
                    <label for="12:00-13:00"> 12:00-13:00</label><br>
                    <input type="checkbox"class="saat" id="13:00-14:00" <?php if (isset($calismasaatiId) && $calismasaatiId == "calismasaatiId") echo "checked"; ?> name="calismasaatiId" value="13:00-14:00"> 
                    <label for="13:00-14:00"> 13:00-14:00</label>
                    <input type="checkbox" class="saat"id="14:00-15:00" <?php if (isset($calismasaatiId) && $calismasaatiId == "calismasaatiId") echo "checked"; ?> name="calismasaatiId" value="14:00-15:00"> 
                    <label for="14:00-15:00"> 14:00-15:00</label>
                    <input type="checkbox"class="saat" id="15:00-16:00" <?php if (isset($calismasaatiId) && $calismasaatiId == "calismasaatiId") echo "checked"; ?> name="calismasaatiId" value="15:00-16:00"> 
                    <label for="15:00-16:00"> 15:00-16:00</label>
                    <input type="checkbox"class="saat" id="16:00-17:00" <?php if (isset($calismasaatiId) && $calismasaatiId == "calismasaatiId") echo "checked"; ?> name="calismasaatiId" value="16:00-17:00"> 
                    <label for="16:00-17:00"> 16:00-17:00</label><br>
                    <input type="checkbox"class="saat" id="17:00-18:00" <?php if (isset($calismasaatiId) && $calismasaatiId == "calismasaatiId") echo "checked"; ?> name="calismasaatiId" value="17:00-18:00"> 
                    <label for="17:00-18:00"> 17:00-18:00</label>
                    <input type="checkbox" class="saat"id="18:00-19:00" <?php if (isset($calismasaatiId) && $calismasaatiId == "calismasaatiId") echo "checked"; ?> name="calismasaatiId" value="18:00-19:00"> 
                    <label for="18:00-19:00"> 18:00-19:00</label>
                    <input type="checkbox" class="saat"id="19:00-20:00" <?php if (isset($calismasaatiId) && $calismasaatiId == "calismasaatiId") echo "checked"; ?> name="calismasaatiId" value="19:00-20:00">
                    <label for="19:00-20:00"> 19:00-20:00</label>
                    <input type="checkbox" class="saat"id="20:00-21:00" <?php if (isset($calismasaatiId) && $calismasaatiId == "calismasaatiId") echo "checked"; ?> name="calismasaatiId" value="20:00-21:00">
                    <label for="20:00-21:00"> 20:00-21:00</label><br>
                    <input type="checkbox"class="saat" id="21:00-22:00" <?php if (isset($calismasaatiId) && $calismasaatiId == "calismasaatiId") echo "checked"; ?> name="calismasaatiId" value="21:00-22:00">
                    <label for="21:00-22:00"> 21:00-22:00</label>
                    <input type="checkbox" class="saat"id="22:00-23:00" <?php if (isset($calismasaatiId) && $calismasaatiId == "calismasaatiId") echo "checked"; ?> name="calismasaatiId" value="22:00-23:00">
                    <label for="22:00-23:00"> 22:00-23:00</label>
                    <input type="checkbox" class="saat"id="23:00-00:00" <?php if (isset($calismasaatiId) && $calismasaatiId == "calismasaatiId") echo "checked"; ?> name="calismasaatiId" value="23:00-00:00">
                    <label for="23:00-00:00"> 23:00-00:00</label>
                    <input type="checkbox" class="saat"id="00:00-01:00" <?php if (isset($calismasaatiId) && $calismasaatiId == "calismasaatiId") echo "checked"; ?> name="calismasaatiId" value="00:00-01:00">
                    <label for="00:00-01:00"> 00:00-01:00</label>

                </div>

                <?php echo (!isset($calismasaatiId_err)) ? 'is-invalid' : '' ?><php?>
                     <div class="invalid-feedback" id="calismasaatiId-feedback"><?php echo $calismasaatiId_err; ?></div>

                <div class="input-box" name=detay>
                    <span class="details">Tesis Detayları</span>
                    <textarea id="inputdetails" name="detay" class="inputdetails <?php echo (!empty($detay_err)) ? 'is-invalid':'' ?>" <?php echo $detay;?>   rows="8" cols="50" placeholder="Tesis detaylarını giriniz">
                    </textarea>
                    <span class="invalid-feedback"><?php echo $detay_err?></span>
                </div>
                <div class="input-box" name="fotografId">
                    <span class="details">Tesis fotoğraflarını ekleyiniz</span>
                    <form action="tesissilme.php" method="POST" enctype="multipart/form-data">
                          
                            <input type="file"  name="fotografId"> 
                    </form>

                   

                </div>
                
                    <div class="button">
                        <input type="submit" class="tesisekle" name="tesisekle" value="Tesis Ekle">
                     </div>
               
                        </div>
                    
                    </div>
                </div>          

            </form>

            
        </div>
    </div>
</body>
</html>


<style>
    body {
    display: flex;
    justify-content:right;
    align-items: center;
    height: 100vh;
    padding: 10px;
  
    background-size: cover;
    background-image: url("images/background.jpeg");
  } 

*{
    font-family: 'Kanit', sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    text-align: center;
}

.container{
    max-width: 600px;
    width: 100%;
    height: 975px;
    background-color: #fff;

    padding: 15px 50px;
    border-radius: 15px;
    box-shadow: 0 5px 10px rgba(0,0,0,0.15);
    margin:32%;
    text-align: center;
}

.container .title{
    font-size: 24px;
    font-weight: 600;
    text-align: left;
    background-color: black;
    position: relative;
    animation-name: example;
    animation-duration: 3s;  
    animation-fill-mode: forwards;
}

@keyframes example {
    from {top: 0px;}
    from {top: -150px; background-color: black;}
    to {top: 50px; background-color: white;}
    
  }

form .input-box{
    margin-bottom: 15px;
    width: 500px;
    columns: count 1px;
    
}


.form-control{
    width: 304px;
    
}
.form-control:hover{
    background-color: #f4511e;
    opacity: 0.5;
} 

.form-control:focus{
    background-color:rgb(2, 234, 145);
}


.details {
    display: flex;
    justify-content: center;
    font-weight: bold;
    
}

.content.input-box.details.input{
    padding: top 50px bottom 50px;
}

.button .tesisekle {
    align-self: center;
    background-color: #f4511e;
    opacity: 0.8;
    background-image: none;
    background-position: 0 90%;
    background-repeat: repeat no-repeat;
    background-size: 4px 3px;
    border-radius: 15px 225px 255px 15px 15px 255px 225px 15px;
    border-style: solid;
    border-width: 2px;
    box-shadow: rgba(0, 0, 0, .2) 15px 28px 25px -18px;
    box-sizing: border-box;
    color: #41403e;
    cursor: pointer;
    display: inline-block;
    font-family: Neucha, sans-serif;
    font-size: 1rem;
    line-height: 23px;
    outline: none;
    padding: .75rem;
    text-decoration: none;
    transition: all 235ms ease-in-out;
    border-bottom-left-radius: 15px 255px;
    border-bottom-right-radius: 225px 15px;
    border-top-left-radius: 255px 15px;
    border-top-right-radius: 15px 225px;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
  }
  
  .button .tesisekle:hover {
    box-shadow: rgba(0, 0, 0, .3) 2px 8px 8px -5px;
    transform: translate3d(0, 2px, 0);
    background-color: rgb(2, 234, 145);
  }
  
  .button .tesisekle:focus {
    box-shadow: rgba(0, 0, 0, .3) 2px 8px 4px -6px;
  }

.myfile{
    width: 180px;   
}

.inputdetails{
    width: 500px;
    height: 100px;
}

.inputdetails:hover{
    background-color: #f4511e;
    opacity: 0.5;
}

.inputdetails:focus{
    background-color:rgb(2, 234, 145);
}

.input-box .saat{
    font-size: 24px;
}

.invalid-feedback {
    color: red;
    font-weight: bold;
    font-size: 13px;
    
  }




</style>