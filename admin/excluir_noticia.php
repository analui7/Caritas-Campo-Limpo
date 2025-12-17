<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}
?>

<?php
include('conexao.php');

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Remove o arquivo do servidor
  $arquivo = $conn->query("SELECT pdf FROM noticias WHERE id=$id")->fetch_assoc()['pdf'];
  if (file_exists($arquivo)) unlink($arquivo);

  // Deleta do banco
  $conn->query("DELETE FROM noticias WHERE id=$id");
}

header('Location: listar_noticias.php');
