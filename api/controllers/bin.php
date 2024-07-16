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
  
if(mysqli_num_rows($query)>0)
    {
        $row = mysqli_fetch_array($query);
        echo $row;
        if(password_verify($password,$row['password']) == 1){

                         if($row['first_time_login'] === "yes") {

                                $message1 = "

                                    <html>
                                <head>
                                <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>

                                </head>
                                <body>
                                        <div>
                                        <img src = {$message_banner} style='width:100%' />

                                                <p>Dear {$row['firstname']} </p>
                                                <p> 
                                                    You're officially welcome to Reliance Properties, we are very delighted to welcome you as a new member of this platform,
                                                </p>
                                                    
                                                    <p>kindly get your wallet funded to activate your investment to start earning like others. </p>
                                                    <br>
                            
                                                <p> Best regards</p>
                                        <div>

                                <footer>
                                        <div class='container' style='background-color:black; color:white; border-radius:10px'>
                                                <div class='row' style='padding:8px'>
                                                    <div class='col-3'></div>
                                                        <div class='col-6'>
                                                            <h2>Contact Us </h2>
                                                            <div class='contacts'>
                                                                <div>
                                                                    <p>Email :: info@reliancepropertiesrealtor.com</p>
                                                                </div>
                                                                <div>
                                                                    <span>Mobile :: +1 (908) 944-7739</i></span>
                                                                </div>
                                                                <div>
                                                                    <span> Corporate Hq ::    55 EAST 59TH Street, New York, NY 10022,
                                                                    UNITED STATES </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <div class='col-3'></div>
                                                        <!-- COPYRIGHT STARTS -->
                                                    <div class='row' >
                                                        
                                                        <div class='col-xs-12'>
                                                            <p class='text-center'>&copy; Copyright 2024 <strong><span>Reliance Properties</span></strong>. All Rights Reserved</a></p>
                                                        </div>
                                                    </div>
                                                <!--  COPYRIGHT ENDS -->
                                                </div>
                                            
                                        </div>
                                    
                                </footer>

                            </body>
                            </html> 

                                ";
                                                
                           sendMail($row["email"], "Welcome to Reliance Properties", $message1);
                           $update_status_query= "UPDATE Users SET first_time_login = 'no' WHERE email ='{$row["email"]}' LIMIT 1";
                           $query = mysqli_query($conn, $update_status_query);

                         }
                         
                         
    
      $message2 = "

            <html>
        <head>
           <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>

        </head>
        <body>
                <div>
                  <img src = {$message_banner} style='width:100%' />

                         <p>Dear {$row['firstname']} </p>
                          <p> 
                             You're officially welcome to Reliance Properties, we are very delighted to welcome you as a new member of this platform,
                          </p>
                             
                             <p>kindly get your wallet funded to activate your investment account to start earning like others. </p>
                             <br>
    
                        <p> Best regards</p>
                <div>

         <footer>
                <div class='container' style='background-color:black; color:white; border-radius:10px'>
                         <div class='row' style='padding:8px'>
                             <div class='col-3'></div>
                                <div class='col-6'>
                                    <h2>Contact Us </h2>
                                    <div class='contacts'>
                                        <div>
                                            <p>Email :: info@reliancepropertiesrealtor.com</p>
                                        </div>
                                        <div>
                                            <span>Mobile :: +1 (908) 944-7739</i></span>
                                        </div>
                                        <div>
                                            <span> Corporate Hq ::    55 EAST 59TH Street, New York, NY 10022,
                                            UNITED STATES </span>
                                        </div>
                                    </div>
                                </div>
                               <div class='col-3'></div>
                                 <!-- COPYRIGHT STARTS -->
                            <div class='row' >
                                
                                <div class='col-xs-12'>
                                    <p class='text-center'>&copy; Copyright 2024 <strong><span>Reliance Properties</span></strong>. All Rights Reserved</a></p>
                                </div>
                            </div>
                        <!--  COPYRIGHT ENDS -->
                         </div>
                       
                </div>
            
         </footer>

       </body>
     </html> 

        ";

        
       
        $userInfo = array(
            "fullname" => $row['fullname'],
            "email" => $row['email'],
            "phonenumber" => $row['phonenumber'],
        );

        $token = array(
            "fullname" => $row['fullname'],
            "email" => $row['email'],
            "phonenumber" => $row['phonenumber'],
            "iat" => time(),
            "nbf" => time(),
           
        );

        $key = "YOUR_SECRET_KEY";

        // $accessToken = JWT::encode($token, $key);
        //         $headers = array('alg' => 'HS256', 'typ' => 'JWT');
      //  $payload = array('username' => $row['username'], 'exp' => (time() + 60));

      // $jwt = generate_jwt($headers, $payload);
        $accessToken = "ejerhj45453k4k5k3n45kn23k5rj4jj5453n45n";

        $_COOKIE["accessToken"] = $accessToken;
        $_COOKIE["authenticated"] = TRUE;
                            
                http_response_code(200);
                return json_encode(array('userInfo'=>$userInfo,"message" => "login Successful", "success" => true));  
        
                }else{
                    http_response_code(400);
                   return  json_encode(array("message" => "Invalid Email or Password", "success" => false)); 
                //    return echo json_encode(array("message" => "Invalid Email or Password", "success" => false));   

                }
        }else{
             http_response_code(400);
             return json_encode(array("message" => "Invalid Email or Password", "success" => false));   
    }
          
} else {
    // echo "NOT found";
    return json_encode(array("message" => "Forbidden", "success" => false)); 

}
