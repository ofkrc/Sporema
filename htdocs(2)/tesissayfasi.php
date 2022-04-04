<?php
session_start();
require "ayar.php";
require "functions.php";

$aydi = $_GET["id"];

$query = "SELECT * from tesistable where id = '$aydi'";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);
$rows = mysqli_num_rows($result);

$tesisAd = $row['tesisAd'];
$fotografId = $row['fotografId'];
$detay = $row['detay'];
?>

<?php


if (isset($_POST['action'])) {
  $post_id = $_POST['post_id'];
  $action = $_POST['action'];
  switch ($action) {
      case 'like':
         $sql="INSERT INTO rating_info (userId, post_id, rating_action) 
                VALUES ($userId, $post_id, 'like') 
                ON DUPLICATE KEY UPDATE rating_action='like'";
         break;
      case 'dislike':
          $sql="INSERT INTO rating_info (userId, post_id, rating_action) 
               VALUES ($userId, $post_id, 'dislike') 
                ON DUPLICATE KEY UPDATE rating_action='dislike'";
         break;
      case 'unlike':
          $sql="DELETE FROM rating_info WHERE userId=$userId AND post_id=$post_id";
          break;
      case 'undislike':
            $sql="DELETE FROM rating_info WHERE userId=$user_id AND post_id=$post_id";
      break;
      default:
          break;
  }


  mysqli_query($connection, $sql);
  echo getRating($post_id);
  exit(0);
}


function getLikes($id)
{
  global $connection;
  $sql = "SELECT COUNT(*) FROM rating_info 
            WHERE post_id = $id AND rating_action='like'";
  $rs = mysqli_query($connection, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}


function getDislikes($id)
{
  global $connection;
  $sql = "SELECT COUNT(*) FROM rating_info 
            WHERE post_id = $id AND rating_action='dislike'";
  $rs = mysqli_query($connection, $sql);
  $result = mysqli_fetch_array($rs);
  return $result[0];
}


function getRating($id)
{
  global $connection;
  $rating = array();
  $likes_query = "SELECT COUNT(*) FROM rating_info WHERE post_id = $id AND rating_action='like'";
  $dislikes_query = "SELECT COUNT(*) FROM rating_info 
                      WHERE post_id = $id AND rating_action='dislike'";
  $likes_rs = mysqli_query($connection, $likes_query);
  $dislikes_rs = mysqli_query($connection, $dislikes_query);
  $likes = mysqli_fetch_array($likes_rs);
  $dislikes = mysqli_fetch_array($dislikes_rs);
  $rating = [
      'likes' => $likes[0],
      'dislikes' => $dislikes[0]
  ];
  return json_encode($rating);
}

// Check if user already likes post or not
function userLiked($post_id)
{
  global $connection;
  global $userId;
  $sql = "SELECT * FROM rating_info WHERE userId=$userId 
            AND post_id=$post_id AND rating_action='like'";
 
  
}

// Check if user already dislikes post or not
function userDisliked($post_id)
{
  global $connection;
  global $userId;
  $sql = "SELECT * FROM rating_info WHERE userId=$userId 
            AND post_id=$post_id AND rating_action='dislike'";
}

$sql = "SELECT * FROM posts";
$result = mysqli_query($connection, $sql);
// fetch all posts from database
// return them as an associative array called $posts
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);


if (isset($_POST['save_date'])) {
  $name = $_POST['name'];
  $event_dtd = $_POST['event_dt'];

  $query = "INSERT INTO rez (name,eventdt) VALUES ('$name','$event_dtd')";
  $query_run = mysqli_query($connection, $query);



  if ($query_run) {
    $_SESSION['status'] = "Date values Inserted";
    header("Location: rezervasyonlarım.php");
  } else {
    $_SESSION['status'] = "Date values Inserting Failed";
    header("Location: tesissayfasi.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tesis Sayfası</title>
  <link rel="stylesheet" href="tesissayfasi.css" ;>
  <link rel="stylesheet" href="tesissayfasi.js" ;>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Archivo+Black&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Archivo:700&display=swap" rel="stylesheet">

  <script src="https://kit.fontawesome.com/a6e0102296.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="style.css" ;>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.click').click(function() {
        if ($('.click span').hasClass("fa-star")) {
            $.ajax({
                type : "POST",
                url : "favorite-delete.php",
                data : { userID : <?= $_SESSION[id] ?>, tesisID : <?= $aydi?>}, 
                success : function(result){
                    setTimeout(function() {
                        $('.click').removeClass('active-2')
                    }, 30)
                    $('.click').removeClass('active-3')
                    setTimeout(function() {
                        $('.click span').removeClass('fa-star')
                        $('.click span').addClass('fa-star-o')
                    }, 15)
                }
            });

          
        } else {
            $.ajax({
                type : "POST",
                url : "favoriEkle.php",
                data : { userID : <?= $_SESSION[id] ?>, tesisID : <?= $aydi?>},
                success : function(result){
                   if(result == "OK"){
                       $('.click').addClass('active-2')

                        setTimeout(function() {
                            $('.click span').addClass('fa-star')
                            $('.click span').removeClass('fa-star-o')
                        }, 150)
                        setTimeout(function() {
                            $('.click').addClass('active-3')
                        }, 150)
                        $('.info').addClass('info-tog')
                        setTimeout(function() {
                            $('.info').removeClass('info-tog')
                        }, 1000)
                   }
                }
            });
        }
      })
    });
  </script>



</head>

<body>

  <?php 
    require "navbar.php"; 
    $favorites = "SELECT * FROM favorites WHERE tesis_id=".$aydi." AND user_id=".$_SESSION[id];
    $result = mysqli_query($connection, $favorites);
    $active = false;
    if($result->num_rows > 0){
        $active=true;
    }

  ?>

  <div class="click <?= $active ? 'active-2 active-3': '';?>">
    <span style="color: yellow;" class="fa <?= $active ? 'fa-star': 'fa-star-o';?>"></span>
    <div class="ring"></div>
    <div class="ring2"></div>
    <p class="info">Favorilere Eklendi</p>
  </div>



  <section class="one">
    <div class="title">
      <h1><?php echo $tesisAd ?></h1>
    </div>


    <div class="slideshow-container">

      <div class="mySlides fade">
        <img class="tesisfotografi" src="img/<?php echo $fotografId ?>" style="width:100%">
      </div>
    </div>







    <script>
      var slideIndex = 1;
      showSlides(slideIndex);

      function plusSlides(n) {
        showSlides(slideIndex += n);
      }

      function currentSlide(n) {
        showSlides(slideIndex = n);
      }

      function showSlides(n) {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        if (n > slides.length) {
          slideIndex = 1
        }
        if (n < 1) {
          slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
          slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
      }
    </script>



    <div class="tesisaciklama">
      <div class="titletesisaciklamasi">
        <h1>Tesis Detayları</h1>
      </div>
      <span class="aciklama">

        <p class="yazi"><?php echo $detay ?></p>
      </span>
    </div>

    </div>





  </section>


  <div class="container2">
    <div class="boxs">
      <h5>Rezervasyon Yap</h5><br>
      <div class="card mt-5">

        <div class="card-body">

          <form action="tesissayfasi.php" method="POST">


            <div class="form-group mb-3">
              <label for="">Ad Soyad</label>
              <input type="text" name="name" class="form-control" /><br>
            </div>
            <div class="form-group mb-3"><br>
              <label for="">Tarih ve saat</label>

              <input type="datetime-local" name="event_dt" class="form-control">
            </div>
            <div class="form-group mb-3"><br>
              <button type="submit" name="save_date" class="button">Kaydet</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>



  <div class="posts-wrapper">
  <?php foreach ($posts as $post) : ?>
      <div class="post">
      
  <?php echo '<i class="fas fa-user-alt '.'"></i>'."   ".$post['user'].":"; ?>
        <?php echo $post['text']; ?>
        <!-- yorum kısmı -->
        <div class="post-info">
          <!-- if user likes post, style button differently -->
          <i <?php if (userLiked($post['id'])) : ?> class="fa fa-thumbs-up like-btn" <?php else : ?> class="fa fa-thumbs-o-up like-btn" <?php endif ?> data-id="<?php echo $post['id'] ?>"></i>
          <span class="likes"><?php echo getLikes($post['id']); ?></span>

          &nbsp;&nbsp;&nbsp;&nbsp;

          <!-- if user dislikes post, style button differently -->
          <i <?php if (userDisliked($post['id'])) : ?> class="fa fa-thumbs-down dislike-btn" <?php else : ?> class="fa fa-thumbs-o-down dislike-btn" <?php endif ?> data-id="<?php echo $post['id'] ?>"></i>
          <span class="dislikes"><?php echo getDislikes($post['id']); ?></span>
        </div>
      </div>
    <?php endforeach ?>
  </div>
  <script src="script.js"></script>


  <style>
    .boxs {
      position:fixed;
      top: 58%;
      right: 8%;

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
  </style>





</body>

</html>

<style>
  * {
    box-sizing: border-box;
  }

  body {
    font-family: Verdana, sans-serif;
    margin: 0;
    background-color: black;
    color: white;

  }

  .mySlides {
    display: none;

  }



  img.tesisfotografi {
    vertical-align: middle;
    width: 192px;
    height: 432px;

  }

  /* Slideshow container */


  /* Next & previous buttons */
  .prev,
  .next {
    cursor: pointer;
    position: absolute;
    top: 50%;
    width: auto;
    padding: 16px;
    margin-top: -22px;
    color: white;
    font-weight: bold;
    font-size: 18px;
    transition: 0.6s ease;
    border-radius: 0 3px 3px 0;
    user-select: none;
  }

  /* Position the "next button" to the right */
  .next {
    right: 0;
    border-radius: 3px 0 0 3px;
  }

  /* On hover, add a black background color with a little bit see-through */
  .prev:hover,
  .next:hover {
    background-color: rgba(0, 0, 0, 0.8);
  }

  /* Caption text */
  .text {
    color: #f2f2f2;
    font-size: 15px;
    padding: 8px 12px;
    position: absolute;
    bottom: 8px;
    width: 100%;
    text-align: center;
  }

  /* Number text (1/3 etc) */
  .numbertext {
    color: #f2f2f2;
    font-size: 12px;
    padding: 8px 12px;
    position: absolute;
    top: 0;
  }

  /* Fading animation */
  .fade {
    -webkit-animation-name: fade;
    -webkit-animation-duration: 1.5s;
    animation-name: fade;
    animation-duration: 1.5s;
  }

  @-webkit-keyframes fade {
    from {
      opacity: .4
    }

    to {
      opacity: 1
    }
  }

  @keyframes fade {
    from {
      opacity: .4
    }

    to {
      opacity: 1
    }
  }

  /* On smaller screens, decrease text size */
  @media only screen and (max-width: 300px) {

    .prev,
    .next,
    .text {
      font-size: 11px
    }
  }

  .slideshow-container {
    position: inherit;
    margin-top: -50px;
    margin-left: 50px;
    width: 768px;
    height: 324px;


  }

  .title {
    position: relative;
    display: inline-block;
    left: 70px;
    top: -30px;
    height: 70px;

  }


  .two .container2 {
    position: fixed;
    top: 200px;
    right: 2em;
    width: 35%;
    height: auto;

  }

  .blabla a:focus {
    opacity: 0.5;
    background: linear-gradient(135deg, red, purple);
    color: white;
  }


  .button {
    padding-left: 22px;


  }

  .button input {
    margin-top: 30px;
    margin-left: -36px;
    font-size: 17px;
    font-weight: 100;
    letter-spacing: 1px;
    cursor: pointer;
    border-radius: 15px;
    width: 112%;
    height: 40px;
    background: #02ea91;

  }

  .button:hover {
    opacity: 0.7;
    transition: all 0.3s linear;
  }

  input[type="date"]::-webkit-clear-button {
    display: none;
  }

  /* Removes the spin button */
  input[type="date"]::-webkit-inner-spin-button {
    display: none;
  }

  /* Always display the drop down caret */
  input[type="date"]::-webkit-calendar-picker-indicator {
    color: #2c3e50;
  }

  /* A few custom styles for date inputs */
  input[type="date"] {
    appearance: none;
    -webkit-appearance: none;
    color: #95a5a6;
    font-family: "Helvetica", arial, sans-serif;
    font-size: 18px;
    border: 1px solid #ecf0f1;
    background: rgb(204, 204, 204);
    padding: 5px;
    display: inline-block !important;
    visibility: visible !important;
    border-radius: 10px;
  }

  input[type="date"],
  focus {
    color: black;
    box-shadow: none;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
  }

  .saatler {
    height: auto;
    align-items: center;
  }

  .btn {
    width: 70px;
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



  .blabla {
    width: 30rem;
    margin-top: 20px;
    background-color: white;
    border-radius: 0% 0% 0% 0% / 0% 0% 0% 0%;
    border: #2c3e50 solid;
    color: white;
    box-shadow: 20px 20px rgba(0, 0, 0, .15);
    transition: all .4s ease;

  }



  .date1 {
    padding-left: 22px;

  }

  .rezervasyontitle {
    padding-left: 22px;
  }

  .containerproperties {
    padding-left: 20px;
    padding-top: 400px;
  }

  .containerproperties .titleproperties {
    padding-left: 30px;
    padding-top: 40px;
    margin-top: 80px;
  }

  .icon {
    padding-left: 40px;
    width: 50%;
    display: flex;
    flex-wrap: wrap;
    margin-top: 30px;
  }

  .iconproperties {
    flex: 30%;

  }



  .titletesisaciklamasi {
    padding-left: 30px;
  }

  .aciklama .yazi {
    padding-left: 30px;
    padding-top: 5px;
  }


  .tesisaciklama {
    background-color: var(--background);
    color: white;
    display: block;
    width: 50%;
    min-height: 90px;
    cursor: pointer;
    padding: 50px;
    margin-top: 220px;
    margin-left: 45px;
    margin-right: 100px;
    margin-bottom: 50px;
    border: 3px solid var(--primary);
    box-shadow: 10px -10px 0 -3px var(--background), 10px -10px var(--green),
      20px -20px 0 -3px var(--background), 20px -20px var(--yellow),
      30px -30px 0 -3px var(--background), 30px -30px var(--orange),
      40px -40px 0 -3px var(--background), 40px -40px var(--red);
  }

  .tesisaciklama:hover {
    animation: shadow-wave 1s ease infinite;
  }


  @keyframes shadow-wave {
    0% {
      border: 3px solid var(--primary);
      box-shadow: 10px -10px 0 -3px var(--background), 10px -10px var(--green),
        20px -20px 0 -3px var(--background), 20px -20px var(--yellow),
        30px -30px 0 -3px var(--background), 30px -30px var(--orange),
        40px -40px 0 -3px var(--background), 40px -40px var(--red);
    }

    20% {
      border: 3px solid var(--red);
      box-shadow: 10px -10px 0 -3px var(--background), 10px -10px var(--primary),
        20px -20px 0 -3px var(--background), 20px -20px var(--green),
        30px -30px 0 -3px var(--background), 30px -30px var(--yellow),
        40px -40px 0 -3px var(--background), 40px -40px var(--orange);
    }

    40% {
      border: 3px solid var(--orange);
      box-shadow: 10px -10px 0 -3px var(--background), 10px -10px var(--red),
        20px -20px 0 -3px var(--background), 20px -20px var(--primary),
        30px -30px 0 -3px var(--background), 30px -30px var(--green),
        40px -40px 0 -3px var(--background), 40px -40px var(--yellow);
    }

    60% {
      border: 3px solid var(--yellow);
      box-shadow: 10px -10px 0 -3px var(--background), 10px -10px var(--orange),
        20px -20px 0 -3px var(--background), 20px -20px var(--red),
        30px -30px 0 -3px var(--background), 30px -30px var(--primary),
        40px -40px 0 -3px var(--background), 40px -40px var(--green);
    }

    80% {
      border: 3px solid var(--green);
      box-shadow: 10px -10px 0 -3px var(--background), 10px -10px var(--yellow),
        20px -20px 0 -3px var(--background), 20px -20px var(--orange),
        30px -30px 0 -3px var(--background), 30px -30px var(--red),
        40px -40px 0 -3px var(--background), 40px -40px var(--primary);
    }

    100% {
      border: 3px solid var(--primary);
      box-shadow: 10px -10px 0 -3px var(--background), 10px -10px var(--green),
        20px -20px 0 -3px var(--background), 20px -20px var(--yellow),
        30px -30px 0 -3px var(--background), 30px -30px var(--orange),
        40px -40px 0 -3px var(--background), 40px -40px var(--red);
    }

  }


  :root {
    --primary: #22D2A0;
    --secondary: #192824;
    --background: #192824;
    --green: #1FC11B;
    --yellow: #FFD913;
    --orange: #FF9C55;
    --red: #FF5555;
  }

  .tesisaciklama .titletesisaciklamasi {
    font-size: 15px;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 10px;


  }

  .tesisaciklama .aciklama .yazi {
    font-size: 16px;
    font-weight: normal;

  }




  /* efe */

  a {
    text-decoration: none;
    font-size: 15px;
  }

  :root {
    --btn--size: 60px;
    --btn--color: #ff3466;
    --btn-color-hover: #dadada;
    --icon-size: 25px;
  }

  .likedislike {
    display: inline-block;
    margin-right: 100px;

    justify-content: center;
    align-items: center;

  }

  .bg,
  .buttonld {
    position: absolute;
    font-size: var(--btn--size);
    width: 1em;
    height: 1em;
    border-radius: 50%;
  }

  .bg {
    animation: pulse 1.4s ease infinite;
    background: var(--btn--color);
  }

  .buttonld {
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    z-index: 9999;
    border: none;
    background: var(--btn--color);
    background-size: 18px;
    cursor: pointer;
    outline: none;
    transition: all .2s ease-in .2s;
  }

  .buttonld a {


    color: var(--btn-color-hover);
    font-size: var(--icon-size);
    transition: all .2s ease-in .2s;
  }

  .buttonld:hover a {
    color: var(--btn-color);
  }

  .buttonld:hover {
    background: var(--btn-color-hover);
  }


  @keyframes pulse {
    0% {
      transform: scale(1);
    }

    50% {
      opacity: 0.3;
    }

    100% {
      transform: scale(1.5);
      opacity: 0;
    }
  }

  .buttonyorum input {
    margin-left: 388px;
    font-size: 15px;
    letter-spacing: 0.7px;
    cursor: pointer;
    border-radius: 10px;
    background-color: #ff3466;
    height: 30px;
  }

  .buttonyorum input:hover {

    background-color: #dadada;
    transition: all 0.4s linear;
  }

  textarea {
    margin-top: 20px;
    box-sizing: border-box;
    width: 500px;
    resize: vertical;
    padding: 10px;
    border-radius: 15px;
    border: 0;
    box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.06);
    height: 150px;
    padding-right: 50px;
  }

  img.yuvarlak,
  img.yuvarlak1 {
    border-radius: 50%;
    height: 35px;
    width: 35px;
    left: 460px;

  }

  .yuvarlak1 {
    margin-bottom: -20px;
  }

  .fake-input {
    position: relative;
  }

  .fake-input input {
    border: none;
    display: block;
    width: 100%;
    box-sizing: border-box
  }

  .fake-input img {
    position: absolute;
    top: 2px;
    right: 5px
  }

  .readonly {
    width: 400px;
    height: 100px;

  }

  .efecontainer {
    height: auto;
    position: absolute;
    padding: 2rem 5rem;
  }


  /* mb */


  @import url(//fonts.googleapis.com/css?family=Open+Sans:600,400&subset=latin,cyrillic);



  .click {
    font-size: 28px;
    color: rgba(0, 0, 0, .5);
    width: 38px;
    height: 60px;
    margin: 0 auto;
    margin-top: 20px;
    position: relative;
    cursor: pointer;
  }



  .click span {
    margin-left: 4px;

    z-index: 999;
    position: absolute;
  }

  span:hover {
    opacity: 0.8;
  }

  span:active {
    transform: scale(0.93, 0.93) translateY(2px)
  }

  .ring,
  .ring2 {
    opacity: 0;
    background: grey;
    width: 1px;
    height: 1px;
    position: absolute;
    top: 19px;
    left: 18px;
    border-radius: 50%;
    cursor: pointer;
  }

  .active span,
  .active-2 span {
    color: #F5CC27 !important;
  }

  .active-2 .ring {
    width: 58px !important;
    height: 58px !important;
    top: -10px !important;
    left: -10px !important;
    position: absolute;
    border-radius: 50%;
    opacity: 1 !important;
  }

  .active-2 .ring {
    background: #F5CC27 !important;
  }

  .active-2 .ring2 {
    background: #fff !important;
  }

  .active-3 .ring2 {
    width: 60px !important;
    height: 60px !important;
    top: -11px !important;
    left: -11px !important;
    position: absolute;
    border-radius: 50%;
    opacity: 1 !important;
  }

  .info {
    font-family: 'Open Sans', sans-serif;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    white-space: nowrap;
    color: grey;
    position: relative;
    top: 30px;
    left: -46px;
    opacity: 0;
    transition: all 0.3s ease;
  }

  .info-tog {
    color: #F5CC27;
    position: relative;
    top: 45px;
    opacity: 1;
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

  .posts-wrapper {
  width: 50%;
  margin-left: 50px;
  border: 1px solid #eee;
  float: left;
}
.post {
  width: 90%;
  margin: 20px auto;
  padding: 10px 5px 0px 5px;
  border: 1px solid green;
}
.post-info {
  margin: 10px auto 0px;
  padding: 5px;
}
.fa {
  font-size: 1.2em;
}
.fa-thumbs-down, .fa-thumbs-o-down {
  transform:rotateY(180deg);
}
.logged_in_user {
  padding: 10px 30px 0px;
}
.like-btn, .dislike-btn {
  color: blue;
}

</style>