<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form  method="POST">
    <label for="email"><b>Verify</b></label>
                    <input type="text" onchange="this.form.submit()" placeholder="Enter Code"  name="shownotp" id="email" required>
                    <hr>
                   

    </form>

    <?php if (isset($_POST["shownotp"])){
                        echo $_POST["shownotp"];
                    } ?>
</body>
</html>