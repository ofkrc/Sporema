<?php 


$id = $_SESSION["id"];

$query = "SELECT * from users where id=$id";

$result = mysqli_query($connection,$query);
$row = mysqli_fetch_assoc($result); 
$rows = mysqli_num_rows($result);


  $_SESSION['firstName'] = $row['firstName'];

  $_SESSION['lastName'] = $row['lastName'];

  $_SESSION['number'] = $row['number'];

  $_SESSION['date'] = $row['date'];

  $_SESSION['tc'] = $row['tc'];

  $_SESSION['password'] = $row['password'];

  $_SESSION['reg_date'] = $row['reg_date'];

  $_SESSION['verify'] = $row['verify'];

?>