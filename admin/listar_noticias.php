<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

include('conexao.php');

$busca = isset($_GET['busca']) ? $_GET['busca'] : '';

$sql = "SELECT * FROM noticias 
        WHERE assunto LIKE '%$busca%' OR projetos LIKE '%$busca%' OR area LIKE '%$busca%'
        ORDER BY data DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Notícias</title>
  <style>
    /* Reset básico */
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #fff8f0;
      margin: 0;
      padding: 40px 20px;
      color: #4a4a4a;
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;
    }

    h2 {
      color: #ff6f00;
      font-weight: 700;
      margin-bottom: 25px;
      font-size: 2rem;
      letter-spacing: 1.5px;
    }

    .search-bar {
      width: 100%;
      max-width: 700px;
      margin-bottom: 30px;
      display: flex;
      gap: 10px;
    }

    .search-bar input[type="text"] {
      flex-grow: 1;
      padding: 12px 15px;
      font-size: 16px;
      border: 2px solid #ff6f00;
      border-radius: 8px 0 0 8px;
      transition: 0.3s;
    }
    .search-bar input[type="text"]:focus {
      outline: none;
      border-color: #e65c00;
      box-shadow: 0 0 6px #e65c00;
    }

    .search-bar button {
      background-color: #ff6f00;
      border: none;
      padding: 12px 25px;
      color: white;
      font-weight: 600;
      font-size: 16px;
      cursor: pointer;
      border-radius: 0 8px 8px 0;
      transition: background-color 0.3s;
    }
    .search-bar button:hover {
      background-color: #e65c00;
    }

    table {
      width: 100%;
      max-width: 900px;
      border-collapse: separate;
      border-spacing: 0 12px;
    }

    th, td {
      text-align: left;
      padding: 14px 20px;
      font-size: 15px;
    }

    th {
      background-color: #ffb74d;
      color: #3e2723;
      font-weight: 700;
      border-radius: 10px 10px 0 0;
      user-select: none;
    }

    tbody tr {
      background: white;
      box-shadow: 0 3px 8px rgba(0,0,0,0.07);
      border-radius: 10px;
      transition: background-color 0.3s ease;
    }

    tbody tr:hover {
      background-color: #fff3e0;
    }

    tbody td {
      border-bottom: none;
    }

    td a {
      color: #ff6f00;
      font-weight: 600;
      text-decoration: none;
      margin-right: 8px;
      transition: color 0.3s ease;
    }
    td a:hover {
      color: #e65c00;
      text-decoration: underline;
    }

    .actions {
      white-space: nowrap;
    }

    .back-link {
      margin-top: 40px;
      color: #ff6f00;
      font-weight: 600;
      font-size: 16px;
      text-decoration: none;
      transition: color 0.3s ease;
    }
    .back-link:hover {
      color: #e65c00;
      text-decoration: underline;
    }

    /* Responsividade */
    @media (max-width: 720px) {
      .search-bar {
        flex-direction: column;
      }
      .search-bar input[type="text"], .search-bar button {
        border-radius: 8px !important;
        width: 100%;
      }
      .search-bar button {
        margin-top: 10px;
      }

      table, thead, tbody, th, td, tr {
        display: block;
      }

      thead tr {
        display: none;
      }

      tbody tr {
        margin-bottom: 15px;
        box-shadow: none;
        background: #fff8f0;
        border-radius: 8px;
        padding: 15px;
      }

      tbody td {
        padding: 8px 10px;
        position: relative;
        padding-left: 50%;
        text-align: right;
        font-size: 14px;
      }

      tbody td::before {
        content: attr(data-label);
        position: absolute;
        left: 15px;
        width: 45%;
        padding-left: 10px;
        font-weight: 700;
        text-align: left;
        color: #ff6f00;
        white-space: nowrap;
      }

      .actions {
        white-space: normal;
      }
    }
  </style>
</head>
<body>
  <h2>Notícias</h2>

  <div class="search-bar">
    <form method="get" style="width: 100%; display: flex;">
      <input type="text" name="busca" placeholder="Buscar por assunto, projeto ou área" value="<?= htmlspecialchars($busca) ?>" />
      <button type="submit">Buscar</button>
    </form>
  </div>

  <table>
    <thead>
      <tr>
        <th>Assunto</th>
        <th>Data</th>
        <th>Projetos</th>
        <th>Área</th>
        <th>PDF</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($n = $result->fetch_assoc()) { ?>
        <tr>
          <td data-label="Assunto"><?= htmlspecialchars($n['assunto']) ?></td>
          <td data-label="Data"><?= htmlspecialchars($n['data']) ?></td>
          <td data-label="Projetos"><?= htmlspecialchars($n['projetos']) ?></td>
          <td data-label="Área"><?= htmlspecialchars($n['area']) ?></td>
          <td data-label="PDF"><a href="<?= htmlspecialchars($n['pdf']) ?>" target="_blank" rel="noopener">Ver</a></td>
          <td data-label="Ações" class="actions">
            <a href="editar_noticias.php?id=<?= $n['id'] ?>">Editar</a>|
            <a href="excluir_noticia.php?id=<?= $n['id'] ?>" onclick="return confirm('Excluir essa notícia?')">Excluir</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

  <a class="back-link" href="painel.php">← Voltar ao painel</a>
</body>
</html>
