<?php
$esp = $_GET['esp'] ?? '';
$key = $_GET['key'] ?? '';
$name = $_GET['name'] ?? '';
$action = $_GET['action'] ?? '';

if ($key !== "luiz2025john2020g55667traçosvaga") {
  http_response_code(403);
  exit("INVALID KEY");
}

$commandsFile = "commands.txt";
if ($name && $action) {
  $cmd = $name."=".$action;
  file_put_contents($commandsFile, $cmd."\n", FILE_APPEND);
  echo "OK";
} else {
  echo "NO CMD";
}
