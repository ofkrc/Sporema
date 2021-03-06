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

*{
    font-family: 'Kanit', sans-serif;
    padding: 0;
    margin: 0;
    box-sizing: border-box;
     font-weight: 700;

}

body{
    background-color: black;
    width: 100%;
}

   
    .box1{
        margin-top: 160px;
        margin-right: 400px;
        margin-left: 400px;
        padding: 35px;
       
        
    }
    h1{
        margin-top: -50px;
        font-size: 35px;
        color: #778899;
        font-family: Times New Roman;
        margin-bottom: 15px;
    }
    h2{
        font-size: 27px;
        margin-top: 35px;
        margin-bottom: 15px;
        color: #778899;
        font-family: Times New Roman;
    }
    .s3{
        font-size: 15px;
    
        
    }

    tr{
        margin: 15px;
        
    }
th,td{
    border-top: solid 1px;
    padding: 12px;
    font-size: 15px;
    
}
.s5{
margin-bottom: 70px;
}
.p1{
 font-size: 18px;
 margin-bottom: 20px;
}
#a1,#a2{
    text-decoration: none;
    color: #ADD8E6;
    font-size: 20px;
}
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

</style> 
</head>
<body>
   
  <?php  require "navbar.php";  ?>

    <div class="box1">
    <h1>Sporema ??leti??im Sayfas??</h1>
    <p class="p1">
        G??r???? ve sorular??n??z i??in
        <a href="#" id="a1">sporema@hotmail.com</a>
        adresine mail g??nderebilir veya
        <a href="#" id="a2">0 507 632 1232</a>
        numaral?? telefondan ula??abilirsiniz.
    </p>
<table class="table">
<tbody>
<tr>
    <th>??irket ??nvan??</th>
    <td>Sporema A.??.</td>
</tr>
<tr>
    <th>Adres</th>
    <td>Modernevler mahallesi 3021.sokak no 21 Isparta/Merkez</td>
</tr>
<tr>
<th>Telefon Numaras??</th>
<td>0 507 632 1232</td>
</tr>
<tr>
<th>E-mail</th>
<td>sporema@hotmail.com</td>
</tr>

</tbody>
</table>
<h2>Nas??l rezervasyon yapabilirim</h2>
<p class="s3"> ??? Giri?? yapt??ktan sonra se??ti??iniz tesisin sayfas??na gidip saat ve tarih se??erek rezervasyon yapabilirsiniz.</p>
<h2>Nas??l rezervasyonumu iptal edebilirim</h2>
<p class="s3">??? Rezervasyonlar??m sayfas??na gelip se??ti??iniz rezervasyonu iptal edebilir veya g??ncelleyebilirsiniz.</p>
<h2>Tesisle ilgili ??ikayetim var ne yapmal??y??m</h2>
<p class="s3">??? E-mailden bize ula??abilir veya telefon numaras?? ile destek ekibimize ula??abilirsiniz. </p>
</div>
<?php  require "footer.php";  ?>
</body>
</html>