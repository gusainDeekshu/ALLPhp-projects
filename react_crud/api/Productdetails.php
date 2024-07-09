<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:*");
header("Access-Control-Allow-Methods:*");


$db_conn = mysqli_connect("localhost", "root", "", "reactppdb");
if ($db_conn === false) {
    die("Error:could not connect" . mysqli_connect_error());
}
$method = $_SERVER['REQUEST_METHOD'];
// echo"tes.......".$method;
// die
switch ($method) {
    case "GET";
        $path = explode('/', $_SERVER['REQUEST_URI']);
        if (isset($path[4]) && is_numeric($path[4])) {
            $json_array = array();
            $userid = $path[4];
            // echo "get user id-----".$userid;
            // die;
            $getuserrow = mysqli_query($db_conn, "SELECT * FROM users WHERE id='$userid' ");
            while ($userrow = mysqli_fetch_array($getuserrow)) {

                $json_array["userdata"][] = array("id" => $row['product_id'], "url" => $row["product_url"], "name" => $row["product_name"], "category" => $row["product_category"],"seller" => $row["product_seller"],"price" => $row["product_price"]);
            }
            echo json_encode($json_array["rowuserdata"]);
            return;
        } else {
            $alluser = mysqli_query($db_conn, "SELECT * FROM product");
            if (mysqli_num_rows($alluser) >= 0) {
                while ($row = mysqli_fetch_array($alluser)) {
                    $json_array["userdata"][] = array("id" => $row['product_id'], "url" => $row["product_url"], "name" => $row["product_name"], "category" => $row["product_category"],"seller" => $row["product_seller"],"price" => $row["product_price"]);
                }
                echo json_encode($json_array["userdata"]);
                return;
            } else {
                echo json_encode(["result1" => "please check the data"]);
                return;
            }
        }
        break;


    case "POST";
        $userpostdata = json_decode(file_get_contents("php://input"));
        // echo "sucess data";
        // print_r($userpostdata); die;
        $id = $userpostdata->id;
        $url = $userpostdata->url;
        $name = $userpostdata->name;
        $category = $userpostdata->category;
        $seller = $userpostdata->seller;
        $price = $userpostdata->price;
        $result = mysqli_query($db_conn, "INSERT INTO product(product_id,product_url,product_name,product_category,product_seller,product_price) VALUES('$id','$url','$name','$category','$seller','$price')");
        if ($result) {
            echo json_encode((["sucess" => "user added sucessfully"]));
            return;
        } else {
            echo json_encode((["error" => "please check the user data"]));
            return;
        }

        break;


    case "PUT";
        $userupdate = json_decode(file_get_contents("php://input"));
        // print_r($userupdate);
        $userid = $userupdate->id;
        $username = $userupdate->name;
        $useremail = $userupdate->email;
        $userstatus = $userupdate->status;
        $updatedata = mysqli_query($db_conn, "UPDATE  users SET name='$username',email='$useremail',status='$userstatus' WHERE id='$userid' ");
        if ($updatedata) {
            echo json_encode((["sucess" => "user updated sucessfully"]));
            return;
        } else {
            echo json_encode((["error" => "please check the user data"]));
            return;
        }
        die;
        break;

    case "DELETE";
        $path = explode('/', $_SERVER["REQUEST_URI"]);
        // echo "message userid".$path[4]; die;
        $result = mysqli_query($db_conn, "DELETE FROM users WHERE id='$path[4]' ");
        
        if ($result) {
            echo json_encode((["success" => "user deleted sucessfully"]));
            return;
        } else {
            echo json_encode((["error" => "please check the user data"]));
            return;
        }
        die;
        break;
}
