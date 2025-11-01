<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include("conexao.php");

$data = json_decode(file_get_contents("php://input"), true);
$email = $data["email"] ?? null;

if (!$email) {
    echo json_encode(["error" => "E-mail não fornecido."]);
    exit;
}

$stmt = $conn->prepare("SELECT id, nome, email, imagem_perfil, imagem_status, tipo_usuario, criado_em FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo json_encode(["success" => true, "user" => $user]);
} else {
    echo json_encode(["success" => false, "error" => "Usuário não encontrado."]);
}

$stmt->close();
$conn->close();
?>
