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

                <span id="wrong" onclick="go()">&#10060</span>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <h1 class="textalign">Login</h1>
                    <p class="textalign">Please fill in this form to login your account.</p>
                    <hr>

                    <label for="email"><b>Email</b></label>
                    <input type="text" placeholder="Enter Email" name="email" id="email" required>

                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="psw" minlength="8" id="psw" required>
                    <hr>
                    <p>Wisit website without login<a href="">click here</a>.</p>
                    <input type="submit" name="submit" value="login" class="btn" style="font-size: xx-large;">

                    <div class="container signin">
                        <p>Don't have account? <a href="register.php">Sign up</a>.</p>
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
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT email,pass FROM loginpass";
$result = $conn->query($sql);
$pass = $email = $message = "";
$err = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pass = test_input($_POST["psw"]);
    $email = test_input($_POST["email"]);
}

function test_input($data)
{
    return $data;
}

// output data of each row
while ($row = $result->fetch_assoc()) {
    if ($email == $row["email"] && $pass == $row["pass"]) {
        header("Location: http://127.0.0.1:5500/index.html");
        die();
    } else {
        $err = true;
        fun($err);
    }
}
if (isset($_POST['reg'])) {
    header("Location: http://localhost/php/register.php");
    die();
}
function fun($err)
{
    if ($err == true) {
        if (isset($_POST['submit'])) {
            echo '<script>
           const alert = document.querySelector(".alert");
           display_alert(" please enter valid value", "red")
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
        }
    }
}




$conn->close();
?>


<script>
    function register() {
        location.replace("http://localhost/php/register.php");
    }

    function go() {
        location.replace("http://127.0.0.1:5500/modal.html");
    }
</script>

</html>