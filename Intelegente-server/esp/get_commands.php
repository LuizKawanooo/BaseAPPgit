<?php
$esp = $_GET['esp'] ?? '';
$key = $_GET['key'] ?? '';
if ($key !== "luiz2025john2020g55667traçosvaga") {
  http_response_code(403);
  exit("INVALID KEY");
}

$commandsFile = "commands.txt";

if (file_exists($commandsFile)) {
  echo file_get_contents($commandsFile);
  // limpa após leitura
  file_put_contents($commandsFile, "");
} else {
  echo "";
}
