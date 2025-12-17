
<?php
$servidor = "meu_banco.mysql.dbaas.com.br";
$usuario = "meu_banco";
$senha = "Caritas@Carit1";
$banco = "meu_banco"; // Troque pelo nome real do seu banco

$conn = new mysqli($servidor, $usuario, $senha, $banco);

if ($conn->connect_error) {
  die("Falha na conexão: " . $conn->connect_error);
}
?>
