<?php
header("Content-Type: application/json");

$secrets = [
    2 => "Starbuck's Poker Cheat Codes",
    3 => "The Real Location of Earth (Not Kobol!)",
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
