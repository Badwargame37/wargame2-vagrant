<?php
header("Content-Type: application/json");

$secrets = [
    2 => "Starbuck's Poker Cheat Codes",
    3 => "The Real Location of Earth (Not Kobol!)",
    5 => "Hey OSS117 here is my password 4896be9d0f9da6266f1d6b84401ee701",
    4 => "Hey starbuck look at this https://bit.ly/3BlS71b  from dr zee",
    1 => "Adama secret love book",
];

$userId = $_GET['id'] ?? null;
$agentX = $_GET['agentX'] ?? null;

if ($agentX == 1) {
    http_response_code(403); // Forbidden
    echo json_encode(["message" => "Cylon detected. Must destroy!"]);
    exit;
}

if ($agentX != 2 && $agentX != 3) {
    http_response_code(401); // Unauthorized
    echo json_encode(["message" => "Unauthorized"]);
    exit;
}

if (isset($secrets[$userId])) {
    $secret = $secrets[$userId];
} else {
    $secret = "No such secret";
}

echo json_encode(["userId" => $userId, "secret" => $secret]);
?>
