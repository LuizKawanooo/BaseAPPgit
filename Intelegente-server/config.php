<?php
// === CONFIG GERAL ===
define('SECRET_KEY', 'luiz2025john2020g55667traçosvaga'); // mude isto!

// Um ou mais dispositivos (ESP) que falarão com o servidor
$ALLOWED_ESPS = ['esp1'];

// Dispositivos pré-definidos (devem bater com o firmware)
$PREDEFINED = [
  // LEDs (5)
  ['name' => 'LED1',  'type' => 'LED',   'pin' => 5],   // D1
  ['name' => 'LED2',  'type' => 'LED',   'pin' => 12],  // D6
  ['name' => 'LED3',  'type' => 'LED',   'pin' => 13],  // D7
  ['name' => 'LED4',  'type' => 'LED',   'pin' => 14],  // D5
  ['name' => 'LED5',  'type' => 'LED',   'pin' => 15],  // D8
  // Relés (5)
  ['name' => 'RELAY1','type' => 'RELAY', 'pin' => 4],   // D2
  ['name' => 'RELAY2','type' => 'RELAY', 'pin' => 0],   // D3
  ['name' => 'RELAY3','type' => 'RELAY', 'pin' => 2],   // D4
  ['name' => 'RELAY4','type' => 'RELAY', 'pin' => 16],  // D0
  ['name' => 'RELAY5','type' => 'RELAY', 'pin' => 3],   // RX (evite se usar serial)
];

// Arquivo de fila e de estado por ESP
function queue_file($esp){ return __DIR__."/queue_{$esp}.txt"; }
function state_file($esp){ return __DIR__."/states_{$esp}.json"; }

// Helpers
function check_key_and_esp($esp, $key){
  global $ALLOWED_ESPS;
  if (!in_array($esp, $ALLOWED_ESPS)) {
    http_response_code(403); echo "ESP inválido"; exit;
  }
  if ($key !== SECRET_KEY) {
    http_response_code(403); echo "Chave inválida"; exit;
  }
}
