<?php
require_once __DIR__.'/config.php';

// Params: key, esp, name, action (ON|OFF)
$esp    = isset($_GET['esp'])    ? trim($_GET['esp'])    : '';
$key    = isset($_GET['key'])    ? $_GET['key']          : '';
$name   = isset($_GET['name'])   ? trim($_GET['name'])   : '';
$action = isset($_GET['action']) ? strtoupper($_GET['action']) : '';

check_key_and_esp($esp, $key);

if ($name === '' || ($action !== 'ON' && $action !== 'OFF')) {
  http_response_code(400); echo "Parâmetros inválidos"; exit;
}

$line = $name.'='.$action."\n";
$file = queue_file($esp);

if (!file_put_contents($file, $line, FILE_APPEND)) {
  http_response_code(500); echo "Erro ao gravar comando";
  exit;
}
header('Content-Type: application/json');
echo json_encode(['ok'=>true,'queued'=>$line]);
