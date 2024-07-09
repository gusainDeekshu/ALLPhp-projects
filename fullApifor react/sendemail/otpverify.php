<?php
// define variables and set to empty values


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $otptyped = test_input($_POST["shownotp"]);
  
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
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
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    <input type="hidden" name="hidden" value="<?php echo $_POST["hidden"]; ?>">
    <input type="text" name="shownotp" placeholder="enter otp">
    <button type="submit" name="submit">verify</button>

  </form>
  <?php
  echo "otp generated   - " .$_POST["hidden"];
  echo "otp typed    -" .$otptyped;
  ?>
</body>

</html>