<?php

function isLoggedin()
{

    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        return true;
    } else {
        return false;
    }
}

function getFavorites($userID){
    include "ayar.php";

    $query = "SELECT tes.*, fav.id as favID from tesistable tes LEFT JOIN favorites fav ON tes.id=fav.tesis_id WHERE fav.user_id=$userID";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result;
}

function getBlogs()
{
    include "ayar.php";

    $query = "SELECT * from tesistable";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result;
}


function getBlogById(int $id)
{
    include "ayar.php";

    $query = "SELECT * from tesistable WHERE id='$id'";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result;
}

function getName(int $id)
{
    include "ayar.php";
    

    $query = "SELECT id,firstName,lastName from users WHERE id='$id'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $rows = mysqli_num_rows($result);

    $id = $row['id'];
    $firstName = $row['firstName'];
    $lastName = $row['lastName'];
    return $firstName."&nbsp".$lastName;
  
}

function deleteFavorite(int $id)
{
    include "ayar.php";
    $query = "DELETE FROM favorites WHERE id=$id";
    $result = mysqli_query($connection, $query);
}


function deleteBlog(int $id)
{
    include "ayar.php";
    $query = "DELETE FROM tesistable WHERE id=$id";
    $result = mysqli_query($connection, $query);
}

function control_input($data)
{
    // $data = strip_tags($data);
    $data = htmlspecialchars($data);
    // $title = htmlentities($data);
    $data = stripslashes($data); # sql injection

    return $data;
}


function saveImage($file)
{
    $message = "";
    $uploadOk = 1;
    $fileTempPath = $file["tmp_name"];
    $fileName = $file["name"];
    $fileSize = $file["size"];
    $maxfileSize = ((1024 * 1024) * 1);
    $dosyaUzantilari = array("jpg", "jpeg", "png");
    $uploadFolder = "./img/";

    if ($fileSize > $maxfileSize) {
        $message = "Dosya boyutu fazla.<br>";
        $uploadOk = 0;
    }

    $dosyaAdi_Arr = explode(".", $fileName);
    $dosyaAdi_uzantisiz = $dosyaAdi_Arr[0];
    $dosyaUzantisi = $dosyaAdi_Arr[1];

    if (!in_array($dosyaUzantisi, $dosyaUzantilari)) {
        $message .= "dosya uzantısı kabul edilmiyor.<br>";
        $message .= "kabul edilen dosya uzantıları : " . implode(", ", $dosyaUzantilari) . "<br>";
        $uploadOk = 0;
    }

    $yeniDosyaAdi = md5(time() . $dosyaAdi_uzantisiz) . '.' . $dosyaUzantisi;
    $dest_path = $uploadFolder . $yeniDosyaAdi;

    if ($uploadOk == 0) {
        $message .= "Dosya yüklenemedi.<br>";
    } else {
        if (move_uploaded_file($fileTempPath, $dest_path)) {
            $message .= "dosya yüklendi.<br>";
        }
    }

    return array(
        "isSuccess" => $uploadOk,
        "message" => $message,
        "image" => $yeniDosyaAdi
    );
}
