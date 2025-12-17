<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}
?>

<?php
include('conexao.php');

$mensagem = '';
$tipoMensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $assunto = $_POST['assunto'];
    $data = $_POST['data'];
    $projetos = $_POST['projetos'];
    $area = $_POST['area'];

    $arquivo = $_FILES['pdf'];
    $caminho = '';

    if ($arquivo['error'] === UPLOAD_ERR_OK) {
        $nomeTemporario = $arquivo['tmp_name'];
        $nomeOriginal = basename($arquivo['name']);
        $nomeUnico = uniqid() . '-' . $nomeOriginal;

        $diretorioRelativo = 'uploads/noticias/';
        $diretorioAbsoluto = __DIR__ . '/' . $diretorioRelativo;

        if (!is_dir($diretorioAbsoluto)) {
            mkdir($diretorioAbsoluto, 0777, true);
        }

        $caminhoAbsoluto = $diretorioAbsoluto . $nomeUnico;
        $caminhoRelativo = $diretorioRelativo . $nomeUnico;

        if (move_uploaded_file($nomeTemporario, $caminhoAbsoluto)) {
            $caminho = $caminhoRelativo;

            $sql = "INSERT INTO noticias (assunto, data, projetos, area, pdf) 
                    VALUES ('$assunto', '$data', '$projetos', '$area', '$caminho')";

            if ($conn->query($sql) === TRUE) {
                $mensagem = "✅ Notícia cadastrada com sucesso!";
                $tipoMensagem = "sucesso";
            } else {
                $mensagem = "❌ Erro ao salvar no banco de dados: " . $conn->error;
                $tipoMensagem = "erro";
            }
        } else {
            $mensagem = "❌ Erro ao mover o arquivo para o destino.";
            $tipoMensagem = "erro";
        }
    } else {
        $mensagem = "❌ Erro no upload do arquivo.";
        $tipoMensagem = "erro";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Adicionar Notícia</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #fff3e0, #ffe0b2);
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 30px 20px;
      min-height: 100vh;
    }

    .container {
      background: #fff;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
      max-width: 600px;
      width: 100%;
      margin-top: 20px;
    }

    .logo img {
      max-width: 250px;
      margin-bottom: 25px;
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #333;
    }

    form label {
      display: block;
      margin: 12px 0 6px;
      font-weight: 500;
      color: #555;
    }

    form input[type="text"],
    form input[type="date"],
    form input[type="file"] {
      width: 100%;
      padding: 10px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 15px;
    }

    button[type="submit"] {
      background-color: #FF6F00;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      cursor: pointer;
      margin-top: 20px;
      width: 100%;
      transition: background 0.3s ease;
    }

    button[type="submit"]:hover {
      background-color: #e65c00;
    }

    .mensagem {
      padding: 12px;
      margin-bottom: 20px;
      border-radius: 5px;
      font-weight: bold;
      text-align: center;
    }

    .sucesso {
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }

    .erro {
      background-color: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }

    .back-link {
      display: block;
      margin-top: 25px;
      text-align: center;
      text-decoration: none;
      color: #FF6F00;
      font-weight: 500;
      transition: color 0.3s;
    }

    .back-link:hover {
      color: #e65c00;
    }
  </style>
</head>
<body>

  <div class="logo">
     
  </div>

  <div class="container">
    <h2>Adicionar Notícia</h2>

    <?php if (!empty($mensagem)): ?>
      <div class="mensagem <?= $tipoMensagem ?>">
        <?= $mensagem ?>
      </div>
    <?php endif; ?>

    <form action="" method="post" enctype="multipart/form-data">
      <label>Assunto:</label>
      <input type="text" name="assunto" required>

      <label>Data:</label>
      <input type="date" name="data" required>

      <label>Projetos:</label>
      <input type="text" name="projetos" required>

      <label>Área de Atuação:</label>
      <input type="text" name="area" required>

      <label>PDF:</label>
      <input type="file" name="pdf" accept="application/pdf" required>

      <button type="submit">Salvar Notícia</button>
    </form>

    <a class="back-link" href="painel.php">← Voltar ao painel</a>
  </div>
</body>
</html>
