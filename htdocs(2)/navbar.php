<?php

if (isLoggedin()) {
    require "getdatas.php";
}


?>

<div class="menu">

    <div class="dark-mod">
        <input onclick="myFunction()" type="checkbox" name="">
    </div>

    <div class="box">
        <?php require_once("ayar.php"); ?>
        <form action="arama.php" method="post" name="search">
            <input type="text" class="input" name="txt" onmouseout="document.search.txt.value = ''">
        </form>
        <i class="fas fa-search"></i>
    </div>

    <div class="logo">
        <a href="index.php"><img src="images/logo.png" alt=""></a>
    </div>


    <ul>
        <li class="active"><a href="index.php">Ana Sayfa</a></li>
        <li><a href="iletisim.php">İletişim</a></li>
        <li><a href="tesisler.php">Tesisler</a></li>




        <?php if (isLoggedin()) : ?>

            <li><a href="tesisekleme.php">Tesis Ekleme</a></li>
            <li><a href="">İşlemler</a>
                <div class="iletisim-menu">
                    <ul>
                        <li><a href="rezervasyonlarım.php">Rezervasyonlarım</a></li>
                        <li><a href="favoritelist.php">Favorilerim</a></li>
                        <li><a href="tesissilme.php">Tesislerim</a></li>

                    </ul>
                </div>
            </li>
            <li><a href="profilduzenleme.php" class="user"><i class="fas fa-user-alt"><?php echo "&nbsp" . $_SESSION["firstName"] . "&nbsp" . $_SESSION["lastName"] ?></i></a></li>

    </ul>


<?php else : ?>

    <li><a href="giris_yap.php">Giriş Yap</a></li>

<?php endif; ?>


</div>

<script>
    function myFunction() {
        var element = document.body;
        element.classList.toggle("dark-mode");
    }
</script>


<style>
    .dark-mod {

        float: right;
        transform: translate(-50%, -50%);
        margin-top: 50px;
    }

    input[type="checkbox"] {
        position: relative;
        width: 50px;
        height: 20px;
        -webkit-appearance: none;
        background: #272133;
        outline: none;
        border-radius: 20px;
        box-shadow: inset 0 0 5px rgba(0, 0, 0, .2);
        transition: .5s;
    }

    input:checked[type="checkbox"] {
        background: #DD4453;
    }

    input[type="checkbox"]:before {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        border-radius: 20px;
        top: 0;
        left: 0;
        background: #fff;
        transform: scale(1.1);
        transition: .5s;
        box-shadow: 0 2px 5px rgba(0, 0, 0, .2);
    }

    input:checked[type="checkbox"]:before {
        left: 30px;
    }

    /*arama butonu*/

    .box {

        position: absolute;
        top: 30%;
        right: 8%;

    }

    .input {
        padding: 10px;
        width: 42px;
        height: 40px;
        background: none;
        border: 4px solid #DD4453;
        border-radius: 50px;
        box-sizing: border-box;
        color: #DD4453;
        outline: none;
        transition: .5s;
    }

    .box:hover input {
        width: 150px;
        background: #272133;
        border-radius: 10px;
    }

    .box i {
        position: absolute;
        top: 50%;
        right: 5px;
        transform: translate(-50%, -50%);
        font-size: 16px;
        color: #DD4453;
        transition: .2s;
    }


    .menu img {
        float: left;
        width: 200px;
        margin: 5px;
        margin-top: -45px;
    }


    .menu {
        text-align: center;
        width: 100%;
        position: sticky;
        top: 0;
        background-color: black;
    }


    .menu ul {
        display: inline-flex;
        list-style-type: none;
        margin: 15px;
        margin-left: -90px;
    }

    .menu ul li {
        width: 140px;
        padding: 15px;
        margin: 5px;
        font-size: 14px;
    }

    .menu ul li a {
        text-decoration: none;
        color: white;
    }

    .active,
    .menu ul li:hover {
        background-color: #DD4453;
        border-radius: 15px;
    }

    .iletisim-menu {
        display: none;
    }

    .menu ul li:hover .iletisim-menu {
        display: block;
        position: absolute;
        margin-top: 14px;
        margin-left: -20px;
        font-size: 16px;
        background-color: black;
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }


    .menu ul li:hover .iletisim-menu ul {
        display: inline;
    }

    .menu ul li:hover .iletisim-menu ul li {
        background: transparent;
    }

    .menu ul li:hover .iletisim-menu ul li a:hover {
        color: #DD4453;
    }

    .dark-mode {
        background-color: white;
        color: black;
    }
</style>