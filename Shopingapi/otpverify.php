<?php

$error = "";

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



    $mail->Subject = "YOUR OTP IS";
    $mail->Body = $_POST["hide"];


    $mail->send();
    session_start();
    $_SESSION['otp'] = $_POST["hide"];
    $_SESSION['name'] = $_POST["name"];
    $_SESSION['email'] = $_POST["email"];
    $_SESSION['pwd'] = $_POST["pwd"];
    $_SESSION['phone'] = $_POST["phone"];
    $_SESSION['gender'] = $_POST["gender"];
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <div class="maincontainer">
        <div class="blurbox">

            <div class="container">
                <p class="alert"></p>
                <form method="POST">

                    <span><?php echo $error; ?></span>
                    <h1 class="textalign">VERIFY YOUR GMAIL</h1>
                    <p class="textalign">Enter the confirmation code from the text message</p>
                    <hr>

                    <label for="shownotp"><b>Verify</b></label>
                    <input type="text" placeholder="Enter Code"  name="shownotp" id="email" required>
                    <hr>


                    <input type="submit" name="sub" value="Register" class="btn" style="font-size: xx-large;">

                </form>
                <?php if (isset($_POST["sub"])) {
                    session_start();
                    if ($_SESSION['otp'] == $_POST["shownotp"]) {
                        echo "verified and registered";
                        $name = $_SESSION['name'];
                        $email = $_SESSION['email'];
                        $pass = $_SESSION['pwd'];
                        $phone = $_SESSION['phone'];
                        $gender = $_SESSION['gender'];
    
    
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "logindata";
    
                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        // Check connection
    
    
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
    
    
                        $name =
                            $sql = "INSERT INTO `loginpass` (`sr`, `name`, `email`, `pass`, `gender`, `phoneno`, `time`) VALUES (NULL, '$name', '$email', '$pass', '$gender', '$phone', current_timestamp());";
    
    
                        if ($conn->query($sql) === TRUE) {
    
                            $error = "*Submitted";
                        } else {
                            $error = "";
                        }
    
                        $conn->close();
                    } else {
                        echo "wrong otp";
                    }
                }

               
                ?>
            </div>
        </div>



    </div>


</body>
<?php




?>

// if (isset($_POST["verify"])) {
// if ($otpvar == $_POST["shownotp"]) {

// // }
// } else {
// echo "phir se dekh";
// }
?>

</html>