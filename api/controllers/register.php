<?php
session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

error_reporting(E_ERROR | E_PARSE);
// use \Firebase\JWT\JWT;

require "../config/database.php";
require "../services/mail.php";
require "../utils/functions.php";

$data = json_decode(file_get_contents('php://input'), true);

$fullname = $data->fullname;
$email = $data->email;
$password = $data->password;

// print_r($data);

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

    $code = implode(gen6RandonNum());

    $sql_check_email_query  = "SELECT email from Users WHERE email = '$email' LIMIT 1";
    $req = mysqli_query($conn, $sql_check_email_query);

     if (mysqli_num_rows($req) > 0) {
         
        $passwordhash = password_hash($password,PASSWORD_DEFAULT);
        
        $fullnames = htmlspecialchars(strip_tags($fullname));
        $emails = htmlspecialchars(strip_tags($email));

        $sql_query="INSERT INTO Users(fullname, email, password, email_verify_token) VALUES ('$fullnames', '$emails','$passwordhash','$code')"; 
        $req = mysqli_query($conn, $sql_query);

            if ($req) {
                
                $message1 = "
                    elovme to Adilys
                ";
                   
                
             sendMail( $email, "Account Verification", $message1);
                       //    setcookie("new_user_email", "{$email}", time() + 1800,"/verify-email");
                         
                       http_response_code(200);
                       echo json_encode(array("message" => "Registration Successful", "success" => true));  
            }else{
                http_response_code(400);
                echo json_encode(array("message" => "Registration failed", "success" => false)); 
            }

     }else{
        http_response_code(400);
        echo json_encode(array("message" => " Email Already Exist", "success" => false)); 
     } 
          
} else {
    // echo "NOT found";
    echo json_encode(array("message" => "Forbidden", "success" => false)); 

}
