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
  $edital = $conn->query("SELECT * FROM editais WHERE id = $id")->fetch_assoc();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $ano = $_POST['ano'];
    $tipo = $_POST['tipo'];

    $conn->query("UPDATE editais SET 
      titulo='$titulo', ano='$ano', tipo='$tipo' 
      WHERE id=$id");

    echo "<p>Edital atualizado com sucesso!</p>";
  }
}
?>

<style> 

body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background-color: #ffffff;
  margin: 0;
  padding: 0;
  color: #333;
}

h2 {
  text-align: center;
  color: #d35400;
  margin-top: 40px;
}

form {
  max-width: 500px;
  margin: 40px auto;
  background: #fff;
  padding: 30px;
  border-radius: 10px;
  border: 2px solid #f39c12;
  box-shadow: 0 0 10px rgba(243, 156, 18, 0.2);
}

label {
  font-weight: bold;
  display: block;
  margin-bottom: 8px;
  color: #e67e22;
}

input[type="text"],
input[type="number"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 6px;
  box-sizing: border-box;
  transition: border-color 0.3s ease;
}

input[type="text"]:focus,
input[type="number"]:focus {
  border-color: #e67e22;
  outline: none;
}

button[type="submit"] {
  background-color: #e67e22;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 16px;
  transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
  background-color: #cf711f;
}

a {
  display: block;
  text-align: center;
  margin-top: 20px;
  text-decoration: none;
  color: #e67e22;
  font-weight: bold;
}

a:hover {
  text-decoration: underline;
}

p {
  text-align: center;
  color: #27ae60;
  font-weight: bold;
}


</style>
<h2>Editar Edital</h2>
<form method="post">
  <label>Título:</label><br>
  <input type="text" name="titulo" value="<?= $edital['titulo'] ?>" required><br><br>

  <label>Ano:</label><br>
  <input type="number" name="ano" value="<?= $edital['ano'] ?>" required><br><br>

  <label>Tipo:</label><br>
  <input type="text" name="tipo" value="<?= $edital['tipo'] ?>" required><br><br>

  <button type="submit">Salvar</button>
</form>
<br><a href="listar_editais.php">← Voltar</a>
