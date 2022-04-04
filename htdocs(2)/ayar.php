<?php

    $server ="sql201.epizy.com";
    $username = "epiz_31003784";
    $password = "0fidKBK3IQlIk";
    $database = "epiz_31003784_sporema";

    $connection = mysqli_connect($server, $username, $password, $database);
    mysqli_set_charset($connection, "UTF8");
    if(mysqli_connect_errno() > 0) {
        die("error: ".mysqli_connect_errno());
    }

?>