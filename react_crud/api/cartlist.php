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
            $getuserrow = mysqli_query($db_conn, "SELECT * FROM cartlist WHERE fk_users='$userid' ");
            while ($row = mysqli_fetch_array($getuserrow)) {

                $json_array["userdata"][] = array("id" => $row['cart_id'], "name" => $row["name"], "price" => $row["price"],"seller" => $row["seller"], "category" => $row["category"],"url" => $row["url"],"quantity" => $row['quantity']);
            }
            echo json_encode($json_array["userdata"]);
            return;
        } else {
            $alluser = mysqli_query($db_conn, "SELECT * FROM cartlist");
            if (mysqli_num_rows($alluser) >= 0) {
                while ($row = mysqli_fetch_array($alluser)) {
                    $json_array["userdata"][] = array("id" => $row['cart_id'], "name" => $row["name"], "price" => $row["price"],"seller" => $row["seller"], "category" => $row["category"],"url" => $row["url"]);
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
        $name = $userpostdata->name;
        $price = $userpostdata->price;
        $category = $userpostdata->category;
        $seller = $userpostdata->seller;
        $url = $userpostdata->url;
        $fk_users = $userpostdata->fk_users;
        $quantity = $userpostdata->quantity;
        $result = mysqli_query($db_conn, "INSERT INTO cartlist(name,price,category,seller,url,fk_users,quantity) VALUES('$name','$price','$category','$seller','$url','$fk_users','$quantity')");
        if ($result) {
            echo json_encode((["sucess" => "added to cart sucessfully"]));
            return;
        } else {
            echo json_encode((["error" => "please check the user data"]));
            return;
        }

        break;


    // case "PUT";
    //     $userupdate = json_decode(file_get_contents("php://input"));
    //     // print_r($userupdate);
    //     $userid = $userupdate->id;
    //     $username = $userupdate->name;
    //     $useremail = $userupdate->email;
    //     $userstatus = $userupdate->status;
    //     $updatedata = mysqli_query($db_conn, "UPDATE  users SET name='$username',email='$useremail',status='$userstatus' WHERE id='$userid' ");
    //     if ($updatedata) {
    //         echo json_encode((["sucess" => "user updated sucessfully"]));
    //         return;
    //     } else {
    //         echo json_encode((["error" => "please check the user data"]));
    //         return;
    //     }
    //     die;
    //     break;

    case "DELETE";
        $path = explode('/', $_SERVER["REQUEST_URI"]);
        // echo "message userid".$path[4]; die;
        $result = mysqli_query($db_conn, "DELETE FROM cartlist WHERE cart_id='$path[4]' ");
        
        if ($result) {
            echo json_encode((["success" => "removed sucessfully"]));
            return;
        } else {
            echo json_encode((["error" => "please check the user data"]));
            return;
        }
        die;
        break;


        case "PUT";
        $userupdate = json_decode(file_get_contents("php://input"));
        $userid = $userupdate->cart_id;
        $quantity = $userupdate->quantity;
    
        $result = mysqli_query($db_conn, "UPDATE `cartlist` SET `quantity` = '$quantity' WHERE `cartlist`.`cart_id` = '$userid';");
        
        if ($result) {
            echo json_encode((["success" => "updated sucessfully"]));
            return;
        } else {
            echo json_encode((["error" => "please check the user data"]));
            return;
        }
        die;
        break;
    }
