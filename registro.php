<?php
require 'config.php';

if ($_POST) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], ?);

    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->execute([$nome, $email, $senha]);

    echo "Usuário cadastrado!";
}
?>

<form method="post">
  Nome: <input type="text" name="nome"><br>
  Email: <input type="email" name="email"><br>
  Senha: <input type="password" name="senha"><br>
  <button type="submit">Registrar</button>
</form>
