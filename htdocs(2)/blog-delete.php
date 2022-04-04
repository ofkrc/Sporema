<?php 


session_start();
require "ayar.php";
require "functions.php";


$id = $_SESSION['id']; 

$query = "SELECT * from tesistable where user_id='$id'";

$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);
$rows = mysqli_num_rows($result);

$id = $row['id'];


deleteBlog($id);

header("Location:tesissilme.php");


mysqli_close($connection);

?>