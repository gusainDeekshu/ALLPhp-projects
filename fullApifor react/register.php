<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "logindata";
$name = $email = $gender = $pass = $gender = $error = $phone = "";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
    $pass = test_input($_POST["pwd"]);
    $phone = test_input($_POST["phone"]);
    $gender = test_input($_POST["gender"]);
}


function test_input($data)
{
    return $data;
}


if (isset($_POST['submit'])) {
    $sql = "INSERT INTO `loginpass` (`sr`, `name`, `email`, `pass`, `gender`, `phoneno`, `time`) VALUES (NULL, '$name', '$email', '$pass', '$gender', '$phone', current_timestamp());";


    if ($conn->query($sql) === TRUE) {

        $error = "*Submitted";
    }
} else {
    $error ="";
}

$conn->close();
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
                    <span><?php echo $error; ?></span>
                    <h1>Register</h1>
                    <p>Please fill in this form to create an account.</p>
                    <hr>

                    <label for="email"><b>Full Name</b></label>
                    <input type="text" placeholder="Enter Email" name="name" id="email" style="height: 40px;" required>
                    <label for="email"><b>Email</b></label>
                    <input type="text" placeholder="Enter Email" name="email" id="email" style="height: 40px;" required>
                    <label for="email"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="pwd" id="email" style="height: 40px;" required>
                    <label for="psw"><b>Re-Write Password</b></label>
                    <input type="password" placeholder="RE-Enter Password" id="email" style="height: 40px;" required>
                    <label for="phone"><b>Phone Number:</b></label>
                    <input type="tel" id="phone" name="phone" placeholder="123-45-678" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required>
                    <input type="radio" name="gender" value="male"> Male
                    <input type="radio" name="gender" value="female"> Female

                    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

                    <button type="submit" class="btn" name="submit" style="font-size: large; height:fit-content;">register</button>


                    <div class="container signin">
                        <p>You already have account? <a href="loginform.php">Sign in</a>.</p>
                    </div>
                </form>
            </div>


        </div>



    </div>


</body>



<script>
    function register() {
        location.replace("http://localhost/php/register.php");
    }

    function go() {
        location.replace("http://127.0.0.1:5500/modal.html");
    }
</script>

</html>