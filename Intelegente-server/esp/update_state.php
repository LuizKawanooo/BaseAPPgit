<?php
$esp = $_POST['esp'] ?? '';
$key = $_POST['key'] ?? '';
$payload = $_POST['payload'] ?? '';

if ($key !== "luiz2025john2020g55667traçosvaga") {
  http_response_code(403);
  exit("INVALID KEY");
}

$statesFile = "states.json";
$data = json_decode(file_get_contents($statesFile), true);
if (!$data) $data = [];

$data[$esp] = json_decode($payload, true);

file_put_contents($statesFile, json_encode($data, JSON_PRETTY_PRINT));

echo "OK";
