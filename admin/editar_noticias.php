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
  $noticia = $conn->query("SELECT * FROM noticias WHERE id = $id")->fetch_assoc();

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $assunto = $_POST['assunto'];
    $data = $_POST['data'];
    $projetos = $_POST['projetos'];
    $area = $_POST['area'];

    $conn->query("UPDATE noticias SET 
      assunto='$assunto', data='$data', projetos='$projetos', area='$area' 
      WHERE id=$id");

    echo "<p>Atualizado com sucesso!</p>";
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
input[type="date"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 6px;
  box-sizing: border-box;
  transition: border-color 0.3s ease;
}

input[type="text"]:focus,
input[type="date"]:focus {
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
  width: 100%;
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

<h2>Editar Notícia</h2>
<form method="post">
  <label>Assunto:</label><br>
  <input type="text" name="assunto" value="<?= $noticia['assunto'] ?>" required><br><br>

  <label>Data:</label><br>
  <input type="date" name="data" value="<?= $noticia['data'] ?>" required><br><br>

  <label>Projetos:</label><br>
  <input type="text" name="projetos" value="<?= $noticia['projetos'] ?>" required><br><br>

  <label>Área:</label><br>
  <input type="text" name="area" value="<?= $noticia['area'] ?>" required><br><br>

  <button type="submit">Salvar</button>
</form>
<br><a href="listar_noticias.php">← Voltar</a>
