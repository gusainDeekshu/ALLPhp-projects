<?php
$otp = rand(000000, 999999);
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



            <div class="container" style="width: 60%; height : 100vh;">


                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <h1>Register</h1>
                    <p>Please fill in this form to create an account.</p>
                    <hr>
                    <p class="alert"></p>

                    <input type="hidden" name="hide" value="<?php echo $otp; ?>">

                    <label for="email"><b>Full Name</b></label>
                    <input type="text" placeholder="Enter Email" name="name" id="email" style="height: 40px;" required>
                    <label for="email"><b>Email</b></label>
                    <input type="text" placeholder="Enter Email" name="email" id="email" style="height: 40px;" required>
                    <label for="email"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="pwd" id="email" style="height: 40px;" required>
                    <label for="psw"><b>Re-Write Password</b></label>
                    <input type="password" placeholder="RE-Enter Password" id="email" style="height: 40px;" required>
                    <label for="phone"><b>Phone Number:</b></label>
                    <input type="tel" id="phone" name="phone" placeholder="123-45-678" required>
                    <input type="radio" name="gender" value="male"> Male
                    <input type="radio" name="gender" value="female"> Female

                    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

                    <button type="submit" class="btn" name="submit" style="font-size: large; height:fit-content;">VERIFY</button>


                    <div class="container signin">
                        <p>You already have account? <a href="loginform.php">Sign in</a>.</p>
                    </div>
                </form>
            </div>


        </div>



    </div>


</body>

<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindata";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT email FROM loginpass";
$result = mysqli_query($conn, $sql);
$pass = $email = $message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = test_input($_POST["email"]);
}
function test_input($data)
{
    return $data;
}

while ($row = $result->fetch_assoc()) {
    if ($email == $row["email"]) {
        $err = true;
    }
}
if (isset($_POST['submit'])) {

    if ($err == true) {

        echo '<script>
           const alert = document.querySelector(".alert");
           display_alert("email already taken", "red")
           function display_alert(text, action) {
            alert.classList.add(action);
            alert.textContent = text;
            //remove alert
            setTimeout(function () {
                alert.classList.add(action);
                alert.textContent = "";
            }, 1000)
        }
        </script>';
        echo htmlspecialchars($_SERVER["PHP_SELF"]);
    } else {

        include("otpverify.php");
        header("Location: http://localhost/php/otpverify.php");
        die();
    }
}


mysqli_close($conn);

?>



</html>