<?php
require_once __DIR__.'/config.php';

// Params: key, esp
$esp = isset($_GET['esp']) ? trim($_GET['esp']) : '';
$key = isset($_GET['key']) ? $_GET['key'] : '';

check_key_and_esp($esp, $key);

$file = queue_file($esp);
if (!file_exists($file)) {
  // Sem comandos
  header('Content-Type: text/plain; charset=utf-8');
  echo ""; exit;
}

// Lê e zera (consome a fila)
$cmds = file_get_contents($file);
file_put_contents($file, ""); // limpa a fila

header('Content-Type: text/plain; charset=utf-8');
echo $cmds; // ex.: "LED1=ON\nRELAY2=OFF\n"
