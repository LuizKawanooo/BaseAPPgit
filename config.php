<?php
$host = 'baseapp.mysql.uhserver.com'; // ou IP/URL do servidor, ex: 'tccappionic-bd.mysql.uhserver.com'
$usuario = 'user_baseapp';
$senha = ',,,Pass2025,,,';
$banco = 'baseapp';

$conexao = new mysqli($host, $usuario, $senha, $banco);

// Verifica se ocorreu erro na conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

echo "Conectado com sucesso!";
?>
