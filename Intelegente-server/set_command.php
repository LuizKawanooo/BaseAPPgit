<?php
$esp = $_GET['esp'] ?? '';
$key = $_GET['key'] ?? '';
$name = $_GET['name'] ?? '';
$action = $_GET['action'] ?? '';

// verifica chave
if ($key !== "luiz2025john2020g55667traçosvaga") {
    http_response_code(403);
    exit("INVALID KEY");
}

// caminho absoluto para evitar problemas de diretório
$commandsFile = __DIR__ . "/commands.txt";

// grava comando
if ($name && $action) {
    $cmd = $esp."|".$name."=".$action; // adiciona ESP para multi-ESP
    if (file_put_contents($commandsFile, $cmd."\n", FILE_APPEND | LOCK_EX) === false) {
        http_response_code(500);
        exit("FAILED TO WRITE");
    }
    echo "OK";
} else {
    echo "NO CMD";
}
?>
