<?php

require "ayar.php";

$tesisID = $_POST['tesisID'];
$userID = $_POST['userID'];
$sql = "INSERT INTO favorites( tesis_id, user_id) VALUES(".$tesisID.",".$userID.")";
$result = mysqli_query($connection, $sql);
echo "OK";
//if(mysqli_insert_id($connection)){
?>