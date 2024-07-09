
<?php
$otp=rand(000000,999999);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>send email</title>
</head>
<body>
    <form action="otp.php" method="post">
        email: <input type="email" name="email"><br>
        subject: <input type="text" name="subject"><br>
  <input type="hidden" name="hide" value="<?php echo $otp; ?>">
        <button type="submit" name="submit">submit</button>
    </form>
    
</body>
</html>