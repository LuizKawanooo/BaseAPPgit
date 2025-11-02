<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Content-Type: application/json; charset=UTF-8");

require_once "conexao.php";

$input = json_decode(file_get_contents("php://input"), true);

if (!isset($input["email"]) || empty($input["email"])) {
    echo json_encode(["success" => false, "message" => "E-mail não fornecido."]);
    exit();
}

$email = $conn->real_escape_string($input["email"]);

$sql = "SELECT id, email, imagem_status FROM users WHERE email = '$email' LIMIT 1";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo json_encode(["success" => true, "user" => $user]);
} else {
    echo json_encode(["success" => false, "message" => "Usuário não encontrado."]);
}

$conn->close();
?>
