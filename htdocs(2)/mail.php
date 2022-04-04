<?php
$receiver = $email;
$subject = "Sporema Dogrulama Kodu";
$kod = rand(100000, 999999);
$body = $kod;
$sender = "From:sporemaofficial.gmail.com";

if (mail($receiver, $subject, $body, $sender)) {
    echo "Email sent successfully to $receiver";
} else {
    echo "Sorry, failed while sending mail!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <input type="submit" name="deneme" value="gönder">


</body>

</html>