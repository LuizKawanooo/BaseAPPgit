<?php
$esp = "esp1";
$key = "luiz2025john2020g55667traçosvaga"; // deve bater com o do ESP
$statesFile = "states.json";
$commandsFile = "commands.txt";

// === Carrega estados
$states = json_decode(file_get_contents($statesFile), true)[$esp];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Painel ESP8266</title>
</head>
<body>
  <h2>Painel ESP8266 - <?= htmlspecialchars($esp) ?></h2>
  <table border="1" cellpadding="8">
    <tr><th>Dispositivo</th><th>Estado</th><th>Ações</th></tr>
    <?php foreach ($states as $name => $val): ?>
    <tr>
      <td><?= $name ?></td>
      <td><?= $val ? "Ligado" : "Desligado" ?></td>
      <td>
        <a href="index.php?cmd=<?= $name ?>=ON">Ligar</a> | 
        <a href="index.php?cmd=<?= $name ?>=OFF">Desligar</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </table>
</body>
</html>
<?php
// === Se tiver comando na URL, grava em commands.txt
if (isset($_GET['cmd'])) {
  $cmd = $_GET['cmd'];
  file_put_contents($commandsFile, $cmd."\n", FILE_APPEND);
  header("Location: index.php");
  exit;
}
