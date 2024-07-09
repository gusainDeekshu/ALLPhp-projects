<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;




require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


if(isset($_POST["submit"])){
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host='smtp.gmail.com';
    $mail->SMTPAuth=true;
    $mail->Username='gusaindeekshant@gmail.com';
    $mail->Password='tyrm jyqb gmgu drip';
    $mail->SMTPSecure='ssl';
    $mail->Port=465;


    $mail->setFrom('gusaindeekshant@gmail.com');


    $mail->addAddress($_POST["email"]);


    $mail->isHTML(true);



    $mail->Subject=$_POST["subject"];$mail->Body=$_POST["message"];


    $mail->send();
    echo "<script>
    aler('sent sucessfully');
    document.location.href ='otpverify.php';
    </script>";


}


?>