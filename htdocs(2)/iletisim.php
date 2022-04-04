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
    <h1>Sporema İletişim Sayfası</h1>
    <p class="p1">
        Görüş ve sorularınız için
        <a href="#" id="a1">sporema@hotmail.com</a>
        adresine mail gönderebilir veya
        <a href="#" id="a2">0 507 632 1232</a>
        numaralı telefondan ulaşabilirsiniz.
    </p>
<table class="table">
<tbody>
<tr>
    <th>Şirket Ünvanı</th>
    <td>Sporema A.Ş.</td>
</tr>
<tr>
    <th>Adres</th>
    <td>Modernevler mahallesi 3021.sokak no 21 Isparta/Merkez</td>
</tr>
<tr>
<th>Telefon Numarası</th>
<td>0 507 632 1232</td>
</tr>
<tr>
<th>E-mail</th>
<td>sporema@hotmail.com</td>
</tr>

</tbody>
</table>
<h2>Nasıl rezervasyon yapabilirim</h2>
<p class="s3"> → Giriş yaptıktan sonra seçtiğiniz tesisin sayfasına gidip saat ve tarih seçerek rezervasyon yapabilirsiniz.</p>
<h2>Nasıl rezervasyonumu iptal edebilirim</h2>
<p class="s3">→ Rezervasyonlarım sayfasına gelip seçtiğiniz rezervasyonu iptal edebilir veya güncelleyebilirsiniz.</p>
<h2>Tesisle ilgili şikayetim var ne yapmalıyım</h2>
<p class="s3">→ E-mailden bize ulaşabilir veya telefon numarası ile destek ekibimize ulaşabilirsiniz. </p>
</div>
<?php  require "footer.php";  ?>
</body>
</html>