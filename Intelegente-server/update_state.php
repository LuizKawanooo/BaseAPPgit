<?php
require_once __DIR__.'/config.php';

// ESP envia: POST esp, key, payload (JSON com { "LED1":1, "RELAY2":0, ... })
$esp     = isset($_POST['esp']) ? trim($_POST['esp']) : '';
$key     = isset($_POST['key']) ? $_POST['key']       : '';
$payload = isset($_POST['payload']) ? $_POST['payload'] : '';

check_key_and_esp($esp, $key);

// Valida JSON
$data = json_decode($payload, true);
if (!is_array($data)) {
  http_response_code(400); echo "JSON inválido"; exit;
}

$file = state_file($esp);
$wrap = [
  'esp' => $esp,
  'updated_at' => date('c'),
  'states' => $data
];

if (!file_put_contents($file, json_encode($wrap, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE))) {
  http_response_code(500); echo "Erro ao salvar estado"; exit;
}

header('Content-Type: application/json');
echo json_encode(['ok'=>true]);
