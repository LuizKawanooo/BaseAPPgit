<?php
header('Content-Type: application/json');
session_start();
require 'config.php';

$data = json_decode(file_get_contents('php://input'), true);

$email = $data['email'] ?? '';
$senha = $data['senha'] ?? '';

$stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($senha, $user['senha'])) {
    $_SESSION['usuario'] = $user;
    echo json_encode(['success' => true, 'nome' => $user['nome']]);
} else {
    echo json_encode(['success' => false, 'message' => 'Login inválido']);
}
?>
