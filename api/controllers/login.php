<?php
session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// use \Firebase\JWT\JWT;

require "../config/database.php";
require "../services/mail.php";
require "../utils/functions.php";


$data = json_decode(file_get_contents('php://input'), true);

$email = $data->email;
$password = $data->password;

print_r($data);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//     $user = $data["name"];
//     $sql = "SELECT username,password FROM Logins WHERE username=? limit 1";
//     $stmt = $conn->stmt_init();
//     $stmt->prepare($sql);
//     $stmt->bind_param("s", $user);
//     $stmt->bind_result($username, $password);
//     $stmt->execute();
//     $result = $stmt->get_result();
//     $rows = $result->num_rows;


        $sql= "SELECT * from Users WHERE email='$email' LIMIT 1";
        $query = mysqli_query($conn, $sql);
        print_r($query);
        if(!mysqli_num_rows($query)>0) {
        //         $row = mysqli_fetch_array($query);
        //         echo $row;
        //         if(password_verify($password,$row['password']) == 1){


        //                 $userInfo = array(
        //                     "fullname" => $row['fullname'],
        //                     "email" => $row['email'],
        //                     "phonenumber" => $row['phonenumber'],
        //                 );

        //                 $token = array(
        //                     "fullname" => $row['fullname'],
        //                     "email" => $row['email'],
        //                     "phonenumber" => $row['phonenumber'],
        //                     "iat" => time(),
        //                     "nbf" => time(),
                        
        //                 );

        //         $key = "YOUR_SECRET_KEY";

        //         // $accessToken = JWT::encode($token, $key);
        //         //         $headers = array('alg' => 'HS256', 'typ' => 'JWT');
        //     //  $payload = array('username' => $row['username'], 'exp' => (time() + 60));

        //     // $jwt = generate_jwt($headers, $payload);
        //         $accessToken = "ejerhj45453k4k5k3n45kn23k5rj4jj5453n45n";

        //         $_COOKIE["accessToken"] = $accessToken;
        //         $_COOKIE["authenticated"] = TRUE;
                                    
        //                 http_response_code(200);
        //                 return json_encode(array('userInfo'=>$userInfo,"message" => "login Successful", "success" => true));  
                
        //                 }else{
        //                     http_response_code(400);
        //                 return  json_encode(array("message" => "Invalid Email or Password", "success" => false)); 
                        echo json_encode(array("message" => "Invalid Email or Password2", "success" => true));   

        //                 }
                }else{
        //             http_response_code(400);
          echo json_encode(array("message" => "Invalid Email or Password1", "success" => false));   
            }
                
} else {
    // echo "NOT found";
    return json_encode(array("message" => "Forbidden", "success" => false)); 

}
