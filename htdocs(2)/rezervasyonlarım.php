<?php
session_start();

require "functions.php";
require "ayar.php";



if(isset($_POST['guncelle']))
{
    include "ayar.php";
  
    $mal = $connection->query("SELECT name, eventdt FROM rez");
    $cikti = $mal->fetch_array();
    $name=$cikti["name"];
    $eventdt = $_POST["event_dt"];

    

    $sorgu = ("UPDATE rez SET eventdt = '$eventdt' WHERE name = '$name'");
    $query_run = mysqli_query($connection, $sorgu);

    
    
    if($query_run)
    {
        $_SESSION['status'] = "Date values Inserted";
        header("Location: rezervasyonlarım.php");
    }
    else
    { 
        $_SESSION['status'] = "Date values Inserting Failed";
        header("Location: rezervasyonlarım.php");
    }
}
if (isset($_POST['sil'])) {
    
    include "ayar.php";
    $mal = $connection->query("SELECT name, eventdt FROM rez");
    $cikti = $mal->fetch_array();
    $name=$cikti["name"];

    $sorgu = ("DELETE FROM rez WHERE name = '$name'");
    $query_run = mysqli_query($connection, $sorgu);

   
    if ($query_run) {
        $_SESSION['status'] = "Date values Inserted";
        header("Location: rezervasyonlarım.php");
    } else {
        $_SESSION['status'] = "Date values Inserting Failed";
        header("Location: rezervasyonlarım.php");
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sporema</title>
    <script src="https://kit.fontawesome.com/a6e0102296.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/afd6aa68df.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fontawesome-free-5.15.1/css/all.css">

</head>

<body>
    <?php require "navbar.php"; ?>

    <div class="rez1">

        <?php

      include "ayar.php";


      $sorgu = $connection->query("SELECT name, eventdt FROM rez");
        $cikti = $sorgu->fetch_array();



        $sorgu->close();
        $connection->close();

        ?>

       
        <details>
            <summary>Aktif Rezervasyonlarım</summary>

            
            
            <?php if(!empty($cikti["name"])): ?> 


                <?php echo "" . $cikti["name"] . " adına<br />  " . $cikti["eventdt"] . " Tarihinde rezervasyon bulunmaktadır."; ?>
            <div class="posts-wrapper">

                <button id="myBtn" class="btn-hover color-9">Güncelle</button>
                <form action="rezervasyonlarım.php" method="POST">
                    <button type="submit" class="btn-hover color-1" name="sil">İptal et</button>
                </form>
                
                <?php else: ?>

            <p>Aktif Rezarvasyon bulunmamaktadır.</p>

                <?php endif; ?>
        </details>
        
    </div>


    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h1>Rezervasyon Güncelleme</h1>

            <div class="card mt-5">

                <div class="card-body">

                    <form action="rezervasyonlarım.php" method="POST">

                        <div class="guncelleme"><br>

                            <label for="">Yeni tarih ve saat</label>

                            <br>
                            <form action="rezervasyonlarım.php" method="POST">
                                <input type="datetime-local" name="event_dt" class="form-control">

                        </div>
                        <div class="guncellemebuton">
                            <button type="submit" name="guncelle" class="button">Güncelle</button>
                        </div>
                    </form>
                    </form>

                </div>


            </div>
        </div>
    </div>


    <script>
        // Popup Al
        var modal = document.getElementById('myModal');

        // Kipi açan düğmeyi al
        var btn = document.getElementById("myBtn");

        // Kipi kapatan <span> öğesini edinin
        var span = document.getElementsByClassName("close")[0];

        // Kullanıcı düğmeyi tıklattığında
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // Kullanıcı <span> (x) düğmesini tıkladığında, popup
        span.onclick = function() {
            modal.style.display = "none";
        }

        // Kullanıcı modelden başka herhangi bir yeri tıklattıysa, onu kapatın.
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

<?php require "footer.php";   ?>

</body>

</html>

<style>
    /* Popup (arka plan) */
    * {
        font-family: 'Kanit', sans-serif;
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-weight: 500;

    }

    h5 {
        font-size: 35px;
    }

    .button {
        margin-top: 60px;
        margin: 50px;
        border: black;
        border-radius: 5px;
        color: #fff;
        font-size: 18px;
        font-weight: 600;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, red, purple);
        padding: 15px 25px;
        position: inherit;
        display: inline-block;

    }

    .modal {
        display: none;
        /* Varsayılan olarak gizlidir */
        position: fixed;
        /* Yerinde kal */
        z-index: 1;
        /* Üstte */
        left: 0;
        top: 0;
        width: 100%;
        /* Ful Genişlik */
        height: 100%;
        /* Ful Yükseklik */
        overflow: auto;
        /* Gerekirse kaydırmayı etkinleştir */
        background-color: rgb(0, 0, 0);
        /* Yedek renk */
        background-color: rgba(0, 0, 0, 0.4);
        /* Siyah w / opaklık */
    }

    /* İçerik / Kutu */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        /* % 15 üstten ve ortalanmış */
        padding: 20px;
        border: 1px solid #888;
        width: 600px;
        /* Ekran boyutuna bağlı olarak daha fazla veya daha az olabilir */
    }

    /* Kapat Düğmesi */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .button input {
        margin-top: 30px;
        font-size: 21px;
        font-weight: 100;
        letter-spacing: 1px;
        cursor: pointer;
        border-radius: 15px;
        width: 35%;
        height: 40px;
        background: #155799;
    }

    .button:hover {
        opacity: 0.7;
        transition: all 0.3s linear;
    }

    .saatler {
        height: 40vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
    }

    .btn {
        width: 100px;
        margin: 10px;
        border: 2px solid #155799;
        padding: 5px;
        font-size: 1.15em;
        letter-spacing: 1px;
        color: #155799;
        background-color: #F1F2F2;
        transition: all 0.25s ease-in-out;
        border-radius: 10px;
    }

    .btn:hover {
        background-color: #155799;
        border-color: #155799;
        color: #F1F2F2;
    }

    .btn:active {
        background-color: #155799;
        border-color: #155799;
        color: #F1F2F2;
        box-shadow: none;
    }

    .btn:focus,
    .btn:active:focus {
        background-color: #155799;
        border-color: #155799;
        color: #F1F2F2;
        outline: 5px auto #155799;
    }

    .btn:visited {
        background-color: #155799;
        border-color: #155799;
    }

    h1 {
        text-align: center;
        color: black;
    }

    .button input {
        margin-top: -20px;
        margin-left: 220px;
        font-size: 21px;
        font-weight: 100;
        letter-spacing: 1px;
        cursor: pointer;
        border-radius: 15px;
        width: 25%;
        border: solid 1px;
        height: 35px;
        background: #296aaa;
    }

    .button:hover {
        opacity: 0.7;
        transition: all 0.3s linear;
    }

    details {
        border: 1px solid #aaa;
        border-radius: 4px;
        padding: .5em .5em 0;
        width: 500px;
    }

    summary {
        font-weight: bold;
        margin: -.5em -.5em 0;
        padding: .5em;

    }

    details[open] {
        padding: .5em;
        margin-bottom: -115px;
    }

    details[open] summary {
        border-bottom: 1px solid #aaa;
        margin-bottom: .5em;
    }

    .guncelle {
        font-size: 16px;
        font-weight: 80;
        letter-spacing: 1px;
        cursor: pointer;
        border-radius: 15px;
        width: 20%;
        border: solid 1px;
        height: 30px;
        background: #437ec2;
    }

    .guncelle:hover {
        opacity: 0.7;
        transition: all 0.3s linear;

    }

    .iptal {
        font-size: 16px;
        font-weight: 80;
        letter-spacing: 1px;
        cursor: pointer;
        border-radius: 15px;
        width: 20%;
        border: solid 1px;
        height: 30px;
        background: #296aaa;
    }

    .btn-hover {
        margin-top: 15px;
        width: 20%;
        font-size: 16px;
        font-weight: 80;
        color: #fff;
        cursor: pointer;
        height: 35px;
        text-align: center;
        border: none;
        background-size: 300% 100%;

        border-radius: 50px;
        -moz-transition: all .4s ease-in-out;
        -o-transition: all .4s ease-in-out;
        -webkit-transition: all .4s ease-in-out;
        transition: all .4s ease-in-out;
    }

    .btn-hover:hover {
        background-position: 100% 0;
        -moz-transition: all .4s ease-in-out;
        -o-transition: all .4s ease-in-out;
        -webkit-transition: all .4s ease-in-out;
        transition: all .4s ease-in-out;
    }

    .btn-hover:focus {
        outline: none;
    }

    .btn-hover.color-9 {
        background-image: linear-gradient(to right, #25aae1, #4481eb, #04befe, #3f86ed);
        box-shadow: 0 4px 15px 0 rgba(65, 132, 234, 0.75);
    }

    .btn-hover.color-1 {
        background-image: linear-gradient(to right, #25aae1, #40e495, #30dd8a, #2bb673);
        box-shadow: 0 4px 15px 0 rgba(49, 196, 190, 0.75);
    }


    .rez1 {
        margin-bottom: 592px;
        margin-top: 120px;
    }

    * {
        font-family: 'Kanit', sans-serif;
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-weight: 600;

    }

    body {
        background-color: black;
        color: white;
    }

    .guncelleme {
        color: black;
        margin-left: 170px;
    }

    .guncellemebuton {
        margin-left: 140px;
    }
</style>