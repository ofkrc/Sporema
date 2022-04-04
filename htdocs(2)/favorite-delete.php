<?php 


session_start();
require "ayar.php";
require "functions.php";

if(isset($_REQUEST['id'])){
    $id = $_REQUEST['id']; 
    deleteFavorite($id);    
}else{
    $userID = $_REQUEST['userID'];
    $tesisID = $_REQUEST['tesisID'];

    $query = "SELECT id FROM favorites WHERE user_id=$userID AND tesis_id = $tesisID";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    deleteFavorite($row['id']);  
}


header("Location:favoritelist.php");


mysqli_close($connection);

?>