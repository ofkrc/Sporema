<?php
session_start();
require "ayar.php";
require "functions.php";
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2&display=swap" rel="stylesheet">
    <title>Tesis Listeleme</title>
</head>

<body>

    <?php require "navbar.php"; ?>


    <div class="tesissilbaslik">
        <h1>Tesislerim</h1>
    </div>

    <div class="container-one">
        <table class="table">
            <thead>
                <tr>
                    <th class="fotograf">Fotoğraf</th>
                    <th class="tesisadi">Tesis Adı</th>
                    <th class="tesisturu">Tesis Türü</th>
                    <th class="tesissehir">Şehir</th>
                    <th class="tesisucreti">Tesis Ücreti</th>
                    <th class="tesisbuton">Tesis Sil</th>
                </tr>
            </thead>




          
            <tbody>
                  <?php $result = getBlogs(); while($film = mysqli_fetch_assoc($result)): ?>
                    <?php if($_SESSION["id"]==$film["user_id"]): ?>
                <tr>
                   
                    <td><img class="tesisfotografi" src="img/<?php echo $film["fotografId"] ?>"></td>
                    <td class="tesisadi" name="tesisAd"> <?php echo $film["tesisAd"] ?> </td>
                    <th class="tesisturu" name="turId"> <?php echo $film["turId"] ?> </th>
                    <th class="tesissehir" name="sehirId"><?php echo $film["sehirId"] ?></th>
                    <th class="tesisucreti" name="tesisUcret"> <?php echo $film["tesisUcret"] ?></th>
                    <th class="tesisbuton">
                        <a class="btn btn-danger btn-sm" id="butonSil" href="blog-delete.php?id=<?php echo $film["id"] ?>">Sil</a>
                    </th>
                   
                </tr>
                
            </tbody>
            <?php endif; ?>
            <?php endwhile; ?>
        </table>
       


    </div>

  


   <?php require"footer.php"; ?>

</body>

</html>

<style>
    * {
        font-family: 'Baloo 2', cursive;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        text-align: center;
    }

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

    .tesisbuton {
        width: 300px;
    }

    #btn {
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

    .butonsil:hover {
        box-shadow: rgba(0, 0, 0, .3) 2px 8px 8px -5px;
        transform: translate3d(0, 2px, 0);
        background-color: rgb(2, 234, 145);
    }

    .buttonsil:focus {
        box-shadow: rgba(0, 0, 0, .3) 2px 8px 4px -6px;
    }



    body {
        background-color: black;
        color: white;
    }

    
    .container-six {
        height: 250px;

        margin-top: 150px;
        border-top: 1px solid;
    }

    .footer {
        column-count: 2;
        text-align: center;
        column-rule: solid 1px;
    }

    .footer a {
        display: inline;
        padding-bottom: 20px;
        font-size: 23px;
        text-decoration: none;
        color: unset;
    }

    .footer a:hover {
        color: gray;
    }

    .footer i {
        margin: 15px;

    }

    .footer .footer-item {
        margin: 25px;
    }

    #mail:hover {
        color: #0073C6;
    }

    #wp:hover {
        color: #56CB63;
    }

    .fa-facebook:hover {
        color: #3C538C;
    }

    .fa-twitter:hover {
        color: #1DA1F2;
    }

    .fa-instagram:hover {
        color: #BA3491;
    }
</style>