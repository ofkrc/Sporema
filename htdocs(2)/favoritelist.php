<?php
session_start();
require "ayar.php";
require "functions.php";




?>




<!DOCTYPE html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">
<link rel="stylesheet" href="favoritelist.css">
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
   
        
    <h1 id="baslik">Favori Listem</h1>
    <table class="styled-table">
        <thead>
            <tr>
                <th class="fotograf">TESİS RESMİ</th>
                <th class="tesisadi">TESİS ADI</th>
                <th class="tesisturu">TESİS TÜRÜ</th>
                <th class="tesissehir">ŞEHİR</th>
                <th class="tesisucreti">FİYAT</th>
                <th> </th>
                
            </tr>
        </thead>
        <tbody>
                  <?php $result = getFavorites($_SESSION["id"]); while($item = mysqli_fetch_assoc($result)): ?>
                <tr>
                   
                    <td><img class="tesisfotografi" src="img/<?php echo $item["fotografId"] ?>" width="250" height="200"></td>
                    <td class="tesisadi" name="tesisAd"> <?php echo $item["tesisAd"] ?> </td>
                    <th class="tesisturu" name="turId"> <?php echo $item["turId"] ?> </th>
                    <th class="tesissehir" name="sehirId"><?php echo $item["sehirId"] ?></th>
                    <th class="tesisucreti" name="tesisUcret"> <?php echo $item["tesisUcret"] ?></th>
                    <th><button class="glow-on-hover" type="button" onClick="location.href='favorite-delete.php?id=<?= $item["favID"] ?>';">FAVORİLERDEN ÇIKART</button></th>
                   
                </tr>
                
            </tbody>
            <?php endwhile; ?>
    </table>
    

    <?php  require"footer.php" ?>
   
    </body>

    </html>


    
<style>
.styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    position: relative;
    margin-left:auto; 
    margin-right:auto;
    position: inherit;
    
}
#baslik {
    text-align: center;
    margin-top: 20px;
    margin-right: 188px;
}
.styled-table thead tr {
    background-color: #009879;
;
    text-align: left;
}
.styled-table th,
.styled-table td {
    padding: 12px 15px;
}
.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
    background-color: white;
    color: #009879;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}
.styled-table tbody tr.active-row {
    font-weight: bold;
    
}





.glow-on-hover {
    width: 220px;
    height: 50px;
    border: none;
    outline: none;
    color: #fff;
    background: #111;
    cursor: pointer;
    position: relative;
    z-index: 0;
    border-radius: 10px;
    
}

.glow-on-hover:before {
    content: '';
    background: linear-gradient(45deg, #ff0000, #ff7300, #fffb00, #48ff00, #00ffd5, #002bff, #7a00ff, #ff00c8, #ff0000);
    position: absolute;
    top: -2px;
    left:-2px;
    background-size: 400%;
    z-index: -1;
    filter: blur(5px);
    width: calc(100% + 4px);
    height: calc(100% + 4px);
    animation: glowing 20s linear infinite;
    opacity: 0;
    transition: opacity .3s ease-in-out;
    border-radius: 10px;
}

.glow-on-hover:active {
    color: #000
}

.glow-on-hover:active:after {
    background: transparent;
}

.glow-on-hover:hover:before {
    opacity: 1;
}

.glow-on-hover:after {
    z-index: -1;
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    background: #111;
    left: 0;
    top: 0;
    border-radius: 10px;
}

@keyframes glowing {
    0% { background-position: 0 0; }
    50% { background-position: 400% 0; }
    100% { background-position: 0 0; }
}




/* footer */
.container-six{
    height: 150px;
    margin-top: 150px;
    border-top: 1px solid;
}

.footer{
    
    column-count: 2;
    text-align: center;
    column-rule:solid 1px;
}

.footer a{

    display: inline;
    padding-bottom: 20px;
    font-size: 23px;
    text-decoration: none;
    color:unset;
}

.footer a:hover{
    color: gray;
}

.footer i{
    margin: 15px;

}

.footer .footer-item{
    margin-top: 30px;
}

#mail:hover{
    color: #0073C6;
}

#wp:hover{
    color: #56CB63;
}
.fa-facebook:hover{
    color:#3C538C;
}
.fa-twitter:hover{
    color:#1DA1F2;
}
.fa-instagram:hover{
    color:#BA3491;
}

/* baslik */

*{
    font-family: 'Kanit', sans-serif;
    padding: 0;
    margin: 0;
    box-sizing: border-box;
   font-weight: 600;
   
}

body{
    background-color: black;
    color: white;
}

.dark-mod{
    
  float: right;
    transform: translate(-50%,-50%);
    margin-top: 50px;
}

input[type="checkbox"]{
    position: relative;
    width: 50px;
    height: 20px;
    -webkit-appearance: none;
    background: #272133;
    outline: none;
    border-radius: 20px;
    box-shadow: inset 0 0 5px rgba(0,0 ,0 ,.2 );
    transition: .5s;
}

input:checked[type="checkbox"]{
    background: #DD4453;
}

input[type="checkbox"]:before{
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
    box-shadow: 0 2px 5px rgba(0,0 ,0 ,.2 );
}

input:checked[type="checkbox"]:before{
    left: 30px;
}

/*nav bar*/

*{
    font-family: 'Kanit', sans-serif;
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-weight: 600;
   
}

body{
    background-color: black;
    color: white;
}

.dark-mod{
    
  float: right;
    transform: translate(-50%,-50%);
    margin-top: 50px;
}

input[type="checkbox"]{
    position: relative;
    width: 50px;
    height: 20px;
    -webkit-appearance: none;
    background: #272133;
    outline: none;
    border-radius: 20px;
    box-shadow: inset 0 0 5px rgba(0,0 ,0 ,.2 );
    transition: .5s;
}

input:checked[type="checkbox"]{
    background: #DD4453;
}

input[type="checkbox"]:before{
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
    box-shadow: 0 2px 5px rgba(0,0 ,0 ,.2 );
}

input:checked[type="checkbox"]:before{
    left: 30px;
}

/*arama butonu*/

.box{
    
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
.box:hover input{
    width: 150px;
    background: #272133;
    border-radius: 10px;
}
.box i{
    position: absolute;
    top: 50%;
    right: 5px;
    transform: translate(-50%,-50%);
    font-size: 16px;
    color: #DD4453;
    transition: .2s;
}


.menu img{
    float: left;
    width: 200px;
    margin: 5px;
    margin-top: -45px;
}


.menu{ 
    text-align: center;
    width: 100%;
    position: sticky;
    top: 0;
    background-color: black;
}


.menu ul{
    display: inline-flex;
    list-style-type: none;
   margin: 15px;
   margin-left: -90px;
}

.menu ul li{
    width: 140px;
    padding: 15px;
    margin: 5px;
    font-size: 14px;
}

.menu ul li a{
    text-decoration: none;
    color: white;
}

.active, .menu ul li:hover{
    background-color: #DD4453;
    border-radius: 15px;
}

.iletisim-menu{
    display: none;
}

.menu ul li:hover .iletisim-menu{
display: block;
position :absolute;
margin-top: 15px;
margin-left: -20px;
font-size: 16px;
background-color: black;
border-bottom-left-radius: 10px;
border-bottom-right-radius: 10px;
}


.menu ul li:hover .iletisim-menu ul{
display: inline;
}

.menu ul li:hover .iletisim-menu ul li{
   background: transparent;
}

.menu ul li:hover .iletisim-menu ul li a:hover{
    color: #DD4453;
}

.dark-mode{
    background-color: white;
    color: black;
}







</style>
