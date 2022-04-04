<?php
session_start();

require "functions.php";
require "ayar.php";

$id = $_SESSION["id"];

$query = ("DELETE FROM users WHERE id=$id");

$result = mysqli_query($connection,$query);

if($result){
    echo "Veri silindi.";
}
else{
    echo "Başarısız";
}

mysqli_close($connection);
require "logout.php";
