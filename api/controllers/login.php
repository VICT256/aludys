<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

session_start();


header("Access-Control-Allow-Origin: http://localhost:3000"); // Adjust this to match your frontend origin
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Credentials: true"); // Allow credentials (cookies) to be sent
header("Access-Control-Max-Age: 3600");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

header("Content-Type: application/json; charset=UTF-8");

require "../config/database.php";
require "../services/mail.php";
require "../utils/functions.php";
require "../vendor/autoload.php"; // Ensure you have this line to include the Firebase JWT library

error_reporting(E_ERROR | E_PARSE);

use \Firebase\JWT\JWT;

$data = json_decode(file_get_contents('php://input'), true);

$email = $data['email'];
$password = $data['password'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) === 1) {
        $row = mysqli_fetch_array($query);

        if (password_verify($password, $row['password'])) {

            $userInfo = array(
                "fullname" => $row['fullname'],
                "email" => $row['email'],
            );

            $key = "grt544353233435435"; // Replace with your secret key
            $payload = array(
                "fullname" => $row['fullname'],
                "email" => $row['email'],
                "iat" => time(),
                "exp" => time() + (7 * 24 * 60 * 60) // Token expiration (7 days)
            );

            $accessToken = JWT::encode($payload, $key, 'HS256');

            // Setting cookies
            setcookie("accessToken", $accessToken, time() + (7 * 24 * 60 * 60), "/", "localhost", false, false); // Secure flag should be true in production (https)
            setcookie("authenticated", "true", time() + (7 * 24 * 60 * 60), "/", "localhost", false, false);

            http_response_code(200);
            echo json_encode(array("message" => "Login Successful", "success" => true, "userInfo" => $userInfo));  
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Invalid Email or Password", "success" => false));   
        }
    } else {
        http_response_code(400);
        echo json_encode(array("message" => "Invalid Email or Password", "success" => false));   
    }
} else {
    http_response_code(403);
    echo json_encode(array("message" => "Forbidden", "success" => false)); 
}