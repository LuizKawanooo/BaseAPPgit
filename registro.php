<?php
header('Content-Type: application/json');
require 'config.php';

$data = json_decode(file_get_contents('php://input'), true);

$nome = $data['nome'] ?? '';
$email = $data['email'] ?? '';
$senha = password_hash($data['senha'] ?? '', PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
$success = $stmt->execute([$nome, $email, $senha]);

if ($success) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao registrar']);
}
?>
