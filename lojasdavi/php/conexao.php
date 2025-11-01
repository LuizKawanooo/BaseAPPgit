<?php
$servername = "lojasdavi.mysql.uhserver.com";
$username = "user_lojasdavi";
$password = "{[Pao2025@";
$dbname = "lojasdavi";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Erro na conexão: " . $conn->connect_error);
}
?>
