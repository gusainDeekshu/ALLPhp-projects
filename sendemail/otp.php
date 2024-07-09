<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;




require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


if (isset($_POST["submit"])) {
  $mail = new PHPMailer(true);

  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'deekshantgusain19@gmail.com';
  $mail->Password = 'cugf lcxa tbzm tqnu';
  $mail->SMTPSecure = 'ssl';
  $mail->Port = 465;


  $mail->setFrom('deekshantgusain19@gmail.com');


  $mail->addAddress($_POST["email"]);


  $mail->isHTML(true);



  $mail->Subject = $_POST["subject"];
  $mail->Body = $_POST["hide"];


  $mail->send();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form action="" method="POST">
    <input type="hidden" name="hide" value="<?php echo $_POST["hide"]; ?>">
    <input type="text" name="shownotp" placeholder="enter otp">
    <button type="submit" name="sub">verify</button>

  </form>
  <?php
  if (isset($_POST["sub"])) {
    if ($_POST["hide"] == $_POST["shownotp"]) {
      echo "verified";
    } else {
      echo "phir se dekh";
    }
  }
  ?>
  </form>
</body>

</html>