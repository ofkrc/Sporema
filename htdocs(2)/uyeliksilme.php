<?php 

require "ayar.php";
require "functions.php";


?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="uyeliksilme.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Sporema | Üyelik Silme</title>
     <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100&family=Ubuntu:wght@300&display=swap" rel="stylesheet">

   </head>
<body>
  <div class="container">
    <div class="title">Üyelik Silme</div>
    <div class="content">
      <form action="#">
     
        <div class="desc">
            Merhaba <br>
            Hesabını silmek istediğini duyduğumuz için üzgünüz.<br>
            Bize hesabını neden silmek istediğini belirtir misin?
        </div>

        <div class="details">
            <input type="radio" name="cinsiyet" id="dot-1">
            <input type="radio" name="cinsiyet" id="dot-2">
            <input type="radio" name="cinsiyet" id="dot-3">
            
            <div class="category">
              <label for="dot-1">
              <span class="dot one"></span>
              <span class="gender">Artık kullanmıyorum</span>
            </label>
            <label for="dot-2">
              <span class="dot two"></span>
              <span class="gender">Yeni hesap açacağım</span>
            </label>
            <label for="dot-3">
              <span class="dot three"></span>
              <span class="gender">Diğer</span>
              </label>
            </div>
          </div>

        <textarea name="aciklama" id="aciklama" cols="60" rows="5" required></textarea>

        <div class="delete">
        <a href="deleteaccount.php">Hesabımı Sil</a>
        </div>
       

      </form>
    </div>
  </div>

</body>
</html>

<style>
  *{
    font-family: 'Kanit', sans-serif;
    padding: 0;
    margin: 0;
    box-sizing: border-box;
   text-align: center;
   font-weight: 600;
}


a{
    text-decoration: none;
}

body{
    display: flex;
    justify-content:right;
    align-items: center;
    height: 100vh;
    padding: 10px;
    background: url(https://miro.medium.com/max/2400/1*9bGtVyWq2Yt5TNZ3oGe8Rw.jpeg);
    background-size: cover;
}

.container{
    max-width: 600px;
    width: 100%;
    height: 600px;
    background-color: #fff;
    padding: 25px 50px;
    border-radius: 15px;
    box-shadow: 0 5px 10px rgba(0,0,0,0.15);
    margin:32%;
    align-items: center;
}

.container .title{
    font-size: 30px;
    font-weight: 600;
    text-align: left;
}

.container .desc,textarea{
    margin-top: 40px;
}

    
.category{
    margin-top: 25px;
    display: block;
    width: 80%;
    margin-left: 60px ;
    justify-content: space-between;
    font-weight: 600;
  }

   .category label{
    display: flex;
    align-items: center;
    cursor: pointer;
  }
.category label .dot{
   height: 18px;
   width: 18px;
   border-radius: 50%;
   margin-right: 10px;
   background: #d9d9d9;
   border: 5px solid transparent;
   transition: all 0.5s ease;
 }

 #dot-1:checked ~ .category label .one,
 #dot-2:checked ~ .category label .two,
 #dot-3:checked ~ .category label .three{
   background: grey;
   border-color: #d9d9d9;
 }
input[type="radio"]{
   display: none;
 }
 
form .delete{
    height: 45px;
    margin-top: 50px;
  }

  form .delete{
    height: 100%;
    width: 100%;
    border-radius: 10px;
    border: black;
    color: #fff;
    font-size: 18px;
    font-weight: 600;
    letter-spacing: 1px;
    cursor: pointer;
    transition: all 0.3s ease;
    background: linear-gradient(135deg, #808080, #000000);
 }

 .delete input:hover{
    background: linear-gradient(85deg, red, purple);
    }

    .delete a {
    padding: 10px 20px;
    display: inline-block;
    font-size: 16px;
    color: white;
  }

    
</style>