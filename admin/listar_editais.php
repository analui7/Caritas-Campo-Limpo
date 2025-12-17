
<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}
?>
<?php
include('conexao.php');

$busca = isset($_GET['busca']) ? $_GET['busca'] : '';

$sql = "SELECT * FROM editais 
        WHERE titulo LIKE '%$busca%' OR tipo LIKE '%$busca%'
        ORDER BY ano DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Editais e Vagas</title>
  <link rel="stylesheet" href="style-admin.css">
</head>
<body>
  <h2>Editais e Vagas</h2>

  <div class="search-bar">
    <form method="get">
      <input type="text" name="busca" placeholder="Buscar por título ou tipo" value="<?= htmlspecialchars($busca) ?>">
      <button type="submit">Buscar</button>
    </form>
  </div>

  <table>
    <tr>
      <th>Título</th>
      <th>Ano</th>
      <th>Tipo</th>
      <th>PDF</th>
      <th>Ações</th>
    </tr>
    <?php while ($e = $result->fetch_assoc()) { ?>
      <tr>
        <td><?= $e['titulo'] ?></td>
        <td><?= $e['ano'] ?></td>
        <td><?= $e['tipo'] ?></td>
        <td><a href="<?= $e['pdf'] ?>" target="_blank">Ver</a></td>
        <td>
          <a href="editar_edital.php?id=<?= $e['id'] ?>">Editar</a> |
          <a href="excluir_edital.php?id=<?= $e['id'] ?>" onclick="return confirm('Excluir este edital?')">Excluir</a>
        </td>
      </tr>
    <?php } ?>
  </table>

  <div style="text-align:center;">
    <a href="painel.php">← Voltar ao painel</a>
  </div>
</body>
</html>
