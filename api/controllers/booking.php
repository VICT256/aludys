<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/Database.php';
include_once '../models/Reservation.php';
include_once '../models/User.php';
include_once '../vendor/autoload.php';
use \Firebase\JWT\JWT;

$database = new Database();
$db = $database->getConnection();

$reservation = new Reservation($db);

$data = json_decode(file_get_contents("php://input"));
$jwt = getallheaders()['Authorization'];
if ($jwt) {
    $jwt = str_replace('Bearer ', '', $jwt);
    try {
        $decoded = JWT::decode($jwt, $reservation->key, array('HS256'));
        $reservation->room_id = $data->room_id;
        $reservation->user_id = $decoded->data->id;
        $reservation->check_in_date = $data->check_in_date;
        $reservation->check_out_date = $data->check_out_date;

        if ($reservation->create()) {
            http_response_code(200);
            echo json_encode(array("message" => "Booking successful.", "success" => true));
        } else {
            http_response_code(503);
            echo json_encode(array("message" => "Unable to book.", "success" => false));
        }
    } catch (Exception $e) {
        http_response_code(401);
        echo json_encode(array("message" => "Access denied.", "error" => $e->getMessage()));
    }
} else {
    http_response_code(401);
    echo json_encode(array("message" => "Access denied."));
}
?>
