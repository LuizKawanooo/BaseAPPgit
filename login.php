<?php
session_start();
require 'config.php';

if ($_POST) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($senha, $user['senha'])) {
        $_SESSION['usuario'] = $user;
        header("Location: index.php");
        exit;
    } else {
        echo "Login inválido";
    }
}
?>

<form method="post">
  Email: <input type="email" name="email"><br>
  Senha: <input type="password" name="senha"><br>
  <button type="submit">Entrar</button>
</form>
