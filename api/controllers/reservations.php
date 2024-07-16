<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/Database.php';
include_once '../models/Reservation.php';
include_once '../vendor/autoload.php';
use \Firebase\JWT\JWT;

$database = new Database();
$db = $database->getConnection();

$reservation = new Reservation($db);

$jwt = getallheaders()['Authorization'];
if ($jwt) {
    $jwt = str_replace('Bearer ', '', $jwt);
    try {
        $decoded = JWT::decode($jwt, $reservation->key, array('HS256'));
        $reservation->user_id = $decoded->data->id;
        $stmt = $reservation->readByUser();
        $num = $stmt->rowCount();

        if ($num > 0) {
            $reservations_arr = array();
            $reservations_arr["records"] = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $reservation_item = array(
                    "id" => $id,
                    "room_id" => $room_id,
                    "check_in_date" => $check_in_date,
                    "check_out_date" => $check_out_date,
                    "room_name" => $room_name
                );
                array_push($reservations_arr["records"], $reservation_item);
            }

            http_response_code(200);
            echo json_encode($reservations_arr);
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "No reservations found."));
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
