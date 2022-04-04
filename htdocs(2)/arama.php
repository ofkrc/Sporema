<?php

session_start();

require "functions.php";
require "ayar.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <script src="https://kit.fontawesome.com/8486c11d89.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sporema</title>
    <script src="https://kit.fontawesome.com/a6e0102296.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/afd6aa68df.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="fontawesome-free-5.15.1/css/all.css">
    <style>
        * {
            font-family: 'Kanit', sans-serif;
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-weight: 700;

        }

        body {
            background-color: black;
            width: 100%;
        }
    </style>
</head>

<body>

    <?php require "navbar.php"; ?>

       

        <div class="container-one">
            <table class="table">
                <thead>
                    <tr>
                        <th class="fotograf">Fotoğraf</th>
                        <th class="tesisadi">Tesis Adı</th>
                        <th class="tesisturu">Tesis Türü</th>
                        <th class="tesissehir">Şehir</th>
                        <th class="tesisucreti">Tesis Ücreti</th>
                        <th class="tesisekleyen">Ekleyen</th>
                        <th class="eklenmeTarihi">Tarih</th>
                    </tr>
                </thead>

                <?php
                require_once("ayar.php");
                $zort="";
                $txt = $_POST["txt"];
                if (empty($txt)) {

                } else {

                    $sorgu = $connection->query("SELECT * FROM tesistable WHERE tesisAd LIKE '%$txt%'");
                    while ($listele = mysqli_fetch_array($sorgu)) {
                        $zort = $listele["tesisAd"] ;
                    }
                    $sorgu = $connection->query("SELECT * FROM tesistable WHERE turId LIKE '%$txt%'");
                    while ($listele = mysqli_fetch_array($sorgu)) {
                        $zort = $listele["turId"] ;
                    }
                    $sorgu = $connection->query("SELECT * FROM tesistable WHERE sehirId LIKE '%$txt%'");
                    while ($listele = mysqli_fetch_array($sorgu)) {
                        $zort = $listele["sehirId"] ;
                    }
                }

if(empty($zort)){
    echo "Böyle bir tesis bulunamadı.";
}
 ?>


<?php
$query = "SELECT * from tesistable WHERE tesisAd = '$zort' OR turId = '$zort' OR sehirId = '$zort'";
$result = mysqli_query($connection, $query);
?>
                <tbody>
                    <?php while ($film = mysqli_fetch_assoc($result)) : ?>
                    
                        <tr>
                            <td><img class="tesisfotografi" src="img/<?php echo $film["fotografId"] ?>"></td>
                            <td class="tesisadi" name="tesisAd"><a href="tesissayfasi.php?id=<?php echo $film["id"] ?>"><?php echo $film["tesisAd"] ?></td>
                            <th class="tesisturu" name="turId"> <?php echo $film["turId"] ?> </th>
                            <th class="tesissehir" name="sehirId"><?php echo $film["sehirId"] ?></th>
                            <th class="tesisucreti" name="tesisUcret"> <?php echo $film["tesisUcret"] ?></th>
                            <th class="tesisekleyen" name="adsoyad"> <?php echo  "&nbsp" . getName($film["user_id"]) . "&nbsp" ?> </th>
                            <th class="eklenmeTarihi" name="eklenmeTarihi"><?php echo  $film["eklenmeTarihi"] ?></th>
                          
                        </tr>
                    <?php endwhile; ?>
                    
                </tbody>
            </table>
        </div>


        <?php require "footer.php";  ?>

    </div>
</body>

</html>

<style>
    .container-one {
        max-width: 1200px;
        width: 80%;
        height: 600px;

        padding: 15px 50px;
        border-radius: 15px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
        margin-left: 15%;
        margin-top: 3%;
        text-align: center;
    }



    .tesissilbaslik {
        position: inherit;
        padding-right: 150px;
        top: 20px;
        left: -480px;
        font-size: 30px;
        font-family: 'Dancing Script', cursive;


    }

    table,
    th,
    td {
        border: 1px solid;
    }

    table {
        border-collapse: collapse;
    }

    tr:hover {

        outline: none;
        cursor: pointer;
    }

    .table .fotograf {
        width: 192px;
        height: 108px;
    }

    .tesisfotografi {
        width: 192px;
        height: 108px;
    }

    .tesisadi {
        width: 700px;
    }

    .tesisturu {
        width: 300px;
    }

    .tesisucreti {
        width: 200px;
    }

    .tesissehir {
        width: 100px;
    }

    tbody .tesisadi:hover{
        background-color:#DD4453;
    }


a{
    color: unset;
}

    body {
        background-color: black;
        color: white;
    }
</style>