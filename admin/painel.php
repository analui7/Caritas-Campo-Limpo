<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Painel Administrativo</title>
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
      justify-content: center;
      min-height: 100vh;
      padding: 20px;
    }

    .logout {
      position: absolute;
      top: 20px;
      right: 30px;
      text-decoration: none;
      background-color: #FF6F00;
      color: white;
      padding: 10px 18px;
      border-radius: 8px;
      font-weight: 500;
      font-size: 14px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .logout:hover {
      background-color: #e65c00;
      transform: scale(1.05);
    }

    .container {
      background: #fff;
      padding: 40px 30px;
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      text-align: center;
      max-width: 700px;
      width: 100%;
    }

    .logo img {
      max-width: 250px;
      margin-bottom: 20px;
    }

    h1 {
      color: #333;
      margin-bottom: 25px;
      font-weight: 600;
      font-size: 26px;
    }

    .button-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
      margin-top: 30px;
    }

    .btn-card {
      background-color: #ffffff;
      color: #444;
      padding: 20px;
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
      text-decoration: none;
      transition: all 0.3s ease;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      font-size: 16px;
      font-weight: 500;
    }

    .btn-card:hover {
      background-color: #FF6F00;
      color: #fff;
      transform: translateY(-4px);
    }

    .btn-card span {
      font-size: 30px;
      margin-bottom: 8px;
    }

     @media (max-width: 768px) {
      .container {
        padding: 30px 20px;
      }

      h1 {
        font-size: 24px;
      }

      .logout {
        padding: 8px 14px;
        font-size: 12px;
      }

      .btn-card {
        padding: 18px;
        font-size: 14px;
      }
    }

    @media (max-width: 480px) {
      .container {
        padding: 20px 15px;
      }

      h1 {
        font-size: 20px;
      }

      .btn-card {
        font-size: 14px;
        padding: 15px;
      }

      .btn-card span {
        font-size: 24px; /* Ajuste no tamanho dos ícones */
      }
    }
  </style>
</head>
<body>
  <a href="logout.php" class="logout">Sair</a>

  <div class="container">
    <div class="logo">
       
    </div>

    <h1>Bem-vindo, <?php echo $_SESSION['email']; ?>!</h1>

    <div class="button-container">
      <a class="btn-card" href="adicionar_noticia.php">
        <span>📰</span>
        Adicionar Notícia
      </a>
      <a class="btn-card" href="adicionar_editais.php">
        <span>📌</span>
        Adicionar Edital
      </a>
      <a class="btn-card" href="listar_noticias.php">
        <span>📄</span>
        Ver Notícias
      </a>
      <a class="btn-card" href="listar_editais.php">
        <span>📁</span>
        Ver Editais
      </a>
    </div>
  </div>
</body>
</html>
