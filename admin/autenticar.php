<?php
session_start();
include('conexao.php');

$email = $_POST['email'];
$senha = $_POST['senha'];

// Usando prepared statements para segurança
$sql = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $senha);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows == 1) {
    $_SESSION['email'] = $email;
    header("Location: painel.php");
    exit;
} else {
    header("Location: login.php?erro=1");
    exit;
}

$conn->close();
?>
