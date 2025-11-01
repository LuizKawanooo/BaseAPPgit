<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
include("conexao.php");

$data = json_decode(file_get_contents("php://input"), true);

$nome = $data["nome"] ?? null;
$email = $data["email"] ?? null;
$senha = $data["senha"] ?? null;

if (!$email || !$senha) {
    echo json_encode(["error" => "E-mail e senha são obrigatórios."]);
    exit;
}

$senha_hash = password_hash($senha, PASSWORD_BCRYPT);

// Verifica se já existe
$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(["message" => "Usuário já cadastrado."]);
    exit;
}

// Insere novo usuário
$stmt = $conn->prepare("
    INSERT INTO users (nome, email, senha_hash, imagem_status, tipo_usuario)
    VALUES (?, ?, ?, 'ativo', 'comum')
");
$stmt->bind_param("sss", $nome, $email, $senha_hash);

if ($stmt->execute()) {
    echo json_encode(["message" => "Usuário cadastrado com sucesso!"]);
} else {
    echo json_encode(["error" => "Erro ao cadastrar usuário."]);
}

$stmt->close();
$conn->close();
?>
