<?php 

session_start();
require "functions.php";
require "ayar.php";




  
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="anasayfastyle.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fontawesome-free-5.15.1/css/all.css">

    <title>Sporema</title>
    <script src="https://kit.fontawesome.com/a6e0102296.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/afd6aa68df.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100&family=Ubuntu:wght@300&display=swap" rel="stylesheet">

</head>
<body>
    
    <?php require "navbar.php"; ?>

<div class="container">
<form action="anasayfa.php" method="POST" novalidate>
    <div class="container-one">

        <div class="randevu">
            <h1 class="header">
                <span>HIZLI, GÜVENİLİR VE HESAPLI SPOR</span>
            </h1>

            <h4 class="header">
                <span>15 dakika içinde planını hazırla.</span>
            </h4>

           <button id="btn1" class="button" onClick="location.href='tesislisteleme.html'">
               Randevu Al
           </button>
        </div>
               
              
    </div>


    <div class="container-two">

        <div class="hakkimizda">
            <h2 class="header">
                <span>Sporema Nedir ?</span>
            </h2>
    
            <h3 class="header">
                <span>Sporema , bütün spor dallarından tesis kiralama ve üyelik işlemlerinin rahatlıkla yapılabildiği güvenilir bir web sayfasıdır.</span>
            </h3>
    
            <button id="btn2" class="button" onClick="location.href='hakkimizda.html'">
                Hakkımızda
                </button>
        </div>
        
    </div>

    <div class="container-three">

        <div class="frame">
            <iframe width="660" height="415" src="https://www.youtube.com/embed/klqdIewal50" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>

        <div class="tanitim">
        
            <h2 class="header">
                <span>Kolay Kullanım</span>
            </h2>
    
            <h3 class="header">
                <span>Sitede daha rahat gezebilmek için sizler için hazırlamış olduğumuz tanıtım videomuza bir göz atmak ister misiniz ?</span>
            </h3>
        </div>
        
    </div>

    <div class="container-four">
       <div class="gallery">

        <div class="item-container">
            <div class="gallery-item">
                <a href="images/football.jpeg" target="_blank">
                    <img src="images/football.jpeg" alt="">
                </a>
                <div class="description">
                    Futbol
                </div>
               </div>
        </div>
           
        <div class="item-container">
            <div class="gallery-item">
                <a href="images/basketball.jpeg" target="_blank">
                    <img src="images/basketball.jpeg" alt="">
                </a>
                <div class="description">
                    Basketbol
                </div>
               </div>
        </div>
           
        <div class="item-container">
            <div class="gallery-item">
                <a href="images/tennis.jpeg" target="_blank">
                    <img src="images/tennis.jpeg" alt="">
                </a>
                <div class="description">
                    Tenis
                </div>
               </div>
        </div>
          
        <div class="item-container">
            <div class="gallery-item">
                <a href="images/bodybuilding.jpeg" target="_blank">
                    <img src="images/bodybuilding.jpeg" alt="">
                </a>
                <div class="description">
                    Fitness
                </div>
        </div>
    </div>
       </div>
    </div>
    <div class="container-seven">

<h2 class="header">Yeni Eklenen Tesisler</h2>

<div class="tesisler">
<?php $result = getBlogs(); while($film = mysqli_fetch_assoc($result)): ?>
    <div class="tesis-container">
        <div class="tesis-item">
        <a href="tesissayfasi.php?id=<?php echo $film["id"]?>" target="_blank">
                <img class="yeniekfoto" src="img/<?php echo $film["fotografId"] ?>"> <style> img.yeniekfoto{width: 192px !important; height: 108px !important;  } </style>
            </a>
            <div class="description">
            <a href="tesissayfasi.php?id=<?php echo $film["id"]?>"><?php echo $film["tesisAd"] ?>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
    
   
    
</div>
</div>



<div class="container-five">

<h2 class="header"> En Çok Kullanılan Tesisler</h2>

<div class="tesisler">
<?php $result = getBlogs(); while($film = mysqli_fetch_assoc($result)): ?>
<div class="tesis-container">
    <div class="tesis-item">
    <a href="tesissayfasi.php?id=<?php echo $film["id"]?>" target="_blank">
        <img class="yeniekfoto" src="img/<?php echo $film["fotografId"] ?>"> <style> img.yeniekfoto{width: 192px !important; height: 108px !important;  } </style>
    </a>
    <div class="description">
    <a href="tesissayfasi.php?id=<?php echo $film["id"]?>"><?php echo $film["tesisAd"] ?>
    </div>
</div>
</div>
<?php endwhile; ?>
    </div>
</div>

    
<?php require"footer.php"; ?>
           
      
</body>
</html>

<style>
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


/*buttons*/

.button{
    width: 25%;
    border: black;
    border-radius: 5px;
    color: #fff;
    font-size: 18px;
    font-weight: 600;
    letter-spacing: 1px;
    cursor: pointer;
    transition: all 0.3s ease;
    background: linear-gradient(135deg, red, purple);
    padding: 25px 35px;
    position: inherit;
    display: inline-block;
    margin-top: 80px;
 }

.button:hover{
    opacity: 70%;
 }

/*container*/

@media screen {

/*container-1*/    
.container-one{
        max-width: 100%;
        width: 100%;
        height: 1080px;
        background: url(images/saha.png);
        padding: 25px;
        text-align:center;
        background-size: contain;
        background-repeat: no-repeat;
    }
}

.randevu{
margin-top: 195px;
margin-left: -380px;
display: inline-block;

}


.randevu h1 span{
    
    font-size: 60px;
    letter-spacing: 3px;
}

.randevu h4 span{
   
    font-size: 20px;
}

/*container-2*/
.container-two{ 
    max-width: 100%;
    width: 100%;
    height: 880px;
    background: url(images/pota.png);
    padding: 25px;
    
    text-align: center;
    background-size: cover;
    background-repeat: no-repeat;
}

.hakkimizda{
display: inline-block;
width: 100%;
margin-top: 200px;
margin-left: -700px;
}

.hakkimizda h2 span{
 font-size: 40px;
letter-spacing: 2px;
}

.hakkimizda h3 span{
font-size: 25px;
display: inline-block;
width: 35%;
margin-top: 40px;
}


/*container-3*/
.container-three{
        max-width: 100%;
        width: 100%;
        height: 600px;
      

}

.tanitim{
text-align: center;
margin-top: 150px;
}

.frame{
    float: left;
    margin-left: 85px;
    margin-top: -50px;
}

.tanitim h2 span{
    font-size: 40px;
    letter-spacing: 2px;
}

.tanitim h3 span{
font-size: 25px;
display: inline-block;
width: 35%;
margin-top: 40px;
}


/*container-4*/
.container-four{
    width: 100%;
    height: 1110px;
     
    text-align: center;
}

.gallery{
    margin: 20px auto;
    text-align: center;
}

.item-container{
    width: 35%;
    padding: 50px;
    display: inline-block;
   
}

.gallery-item:hover ,.tesis-item:hover{
    cursor: pointer;
    opacity: 80%;
}

.gallery-item img{
    width: 100%;
    border-radius: 5px;
}

.description{
    padding: 25px;
    text-align: center;
}

#btn3{
  margin: 0%;
  margin-left: -150px;
  
}

 /*container-5*/   
.container-five{
    height: 550px;
    
    margin-top: 150px;
}

.container-five h2{
    margin-left: 55px;
}

.tesisler{
    margin: 20px auto;
}

.tesis-item a img{
   width: 100%;
   height: 100%;
   border-radius: 5px;
}

.tesis-container{
    width: 15%;
    float: left;
    padding: 5px;
    margin:25px;
}

/*container-7*/

.container-seven{
    height: 450px;
    
    margin-top: 50px;
    
}

.container-seven h2{
    margin-left: 55px;
}

.tesisler{
    margin: 20px auto;
}

.tesis-item a img{
   width: 100%;
   height: 100%;
   border-radius: 5px;
}

.tesis-container{
    width: 15%;
    float: left;
    padding: 5px;
    margin:25px;
}

a{
    text-decoration: none;
    color: unset;
}
</style>