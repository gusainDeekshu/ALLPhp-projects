<?php
// using php mailer smtp to send mail 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;




require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';



error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:*");
header("Access-Control-Allow-Methods:*");

$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case "POST";
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'deekshantgusain19@gmail.com';
        $mail->Password = 'cugf lcxa tbzm tqnu';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;


        $mail->setFrom('deekshantgusain19@gmail.com');

        $userpostdata = json_decode(file_get_contents("php://input"));
        $email = $userpostdata->email;
        $otp = $userpostdata->otp;



        $mail->addAddress($email);


        $mail->isHTML(true);



        $mail->Subject = "YOUR OTP IS";
        $mail->Body = $otp;


        $mail->send();

        if ($mail->send()) {
            echo json_encode((["sucess" => "otp send sucessfully"]));
            return;
        } else {
            echo json_encode((["error" => "please check your email"]));
            return;
        }
        
        break;
}
