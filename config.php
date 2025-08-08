<?php
$host = 'baseapp.mysql.uhserver.com'; // ou IP/URL do servidor, ex: 'tccappionic-bd.mysql.uhserver.com'
$usuario = 'user_baseapp';
$senha = ',,,Pass2025,,,';
$banco = 'baseapp';

$conexao = new mysqli($host, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}

// Captura os dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha_usuario = $_POST['senha'];

// Verifica se o nome ou email já existem
$stmt = $conexao->prepare("SELECT * FROM usuarios WHERE email = ? OR nome = ?");
$stmt->bind_param("ss", $email, $nome);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    echo "Erro: Nome ou e-mail já cadastrados.";
    exit();
}

// Criptografa a senha
$senhaCriptografada = password_hash($senha_usuario, PASSWORD_DEFAULT);

// Insere no banco
$stmt = $conexao->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nome, $email, $senhaCriptografada);

if ($stmt->execute()) {
    // header("Location: login.php"); // Redireciona se quiser
    echo "Usuário cadastrado com sucesso!";
} else {
    echo "Erro ao cadastrar: " . $stmt->error;
}
?>
