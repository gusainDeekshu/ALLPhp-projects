<?php
$otp=rand(000000,999999);
$email="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = test_input($_POST["email"]);
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
    <form action="">
        <input type="email" name="email" placeholder="enter your email">
        <input type="hidden" name="otp" value="<?php echo $otp;?>">
    </form>
</body>
</html>