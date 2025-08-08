<?php
$host = 'baseapp.mysql.uhserver.com'; // ou IP/URL do servidor, ex: 'tccappionic-bd.mysql.uhserver.com'
$usuario = 'user_baseapp';
$senha = ',,,Pass2025,,,';
$banco = 'baseapp';

// Conecta ao banco
$conexao = new mysqli($host, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}
echo "Conectado com sucesso!";

// Captura os dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha_usuario = $_POST['senha'];

// Criptografa a senha do usuário
$senhaCriptografada = password_hash($senha_usuario, PASSWORD_DEFAULT);

// Insere no banco
$stmt = $conexao->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nome, $email, $senhaCriptografada);
$stmt->execute();

echo "Usuário cadastrado com sucesso!";
?>
