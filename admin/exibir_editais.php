<?php
include('../admin/conexao.php');

// Buscar editais mais recentes primeiro
$sql = "SELECT * FROM editais ORDER BY ano DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8" />
<title>Editais - Cáritas Campo Limpo</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../css/style.css" />

<style>
  body {
    font-family: 'Poppins', sans-serif;
    background: #fff;
    margin: 0;
    padding: 0;
    color: #333;
  }
  .container {
    padding: 20px;
    max-width: 1000px;
    margin: 0 auto;
  }
  header {
    text-align: center;
    margin-bottom: 40px;
  }
  header img {
    max-width: 280px;
    width: 100%;
    height: auto;
    margin-bottom: 10px;
  }
  header h1 {
    font-weight: 700;
    font-size: 2.2rem;
    color: #F47A35;
  }
  .intro {
    max-width: 700px;
    margin: 0 auto 40px;
    font-weight: 300;
    font-size: 1rem;
    color: #555;
    text-align: center;
  }
  .banner {
    width: 100%;
    max-height: 280px;
    overflow: hidden;
  }
  .banner img {
    width: 100%;
    height: auto;
    display: block;
    object-fit: cover;
    max-height: 280px;
  }
  .cards-lista {
    max-width: 900px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
  }
  .card {
    background: #FFF6ED;
    padding: 25px 30px;
    border-radius: 15px;
    box-shadow: 0 6px 15px rgba(244, 122, 53, 0.15);
    display: flex;
    flex-direction: column;
    transition: transform 0.3s ease;
    max-width: 600px;
    margin: 0 auto;
    width: 100%;
  }
  .card:hover {
    transform: translateY(-7px);
  }
  .card-titulo {
    font-weight: 700;
    font-size: 1.3rem;
    color: #F47A35;
    margin-bottom: 8px;
  }
  .card-meta,
  .card-tipo {
    font-size: 0.9rem;
    color: #777;
    margin-bottom: 10px;
  }
  .card-preview {
    margin: 15px 0;
    width: 100%;
    height: 280px;
    border: 1px solid #f4a261;
    border-radius: 10px;
    overflow: hidden;
  }
  .card-preview iframe {
    width: 100%;
    height: 100%;
    border: none;
  }
  .card-pdf {
    margin-top: 15px;
    text-align: center;
  }
  .card-pdf a {
    background-color: #F47A35;
    color: #fff;
    padding: 10px 18px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1rem;
    transition: background-color 0.3s ease;
    display: inline-block;
  }
  .card-pdf a:hover {
    background-color: #d35400;
  }
  @media (max-width: 900px) {
    .container {
      max-width: 90%;
      padding: 15px;
    }
    .cards-lista {
      max-width: 100%;
      gap: 20px;
    }
    .card-preview {
      height: 240px;
    }
    .card {
      padding: 20px 20px;
    }
    .banner {
      max-height: 220px;
    }
    .banner img {
      max-height: 220px;
    }
  }
  @media (max-width: 600px) {
    .cards-lista {
      grid-template-columns: 1fr;
    }
    header h1 {
      font-size: 1.8rem;
    }
    .intro {
      font-size: 0.95rem;
      max-width: 100%;
      padding: 0 10px;
    }
    .card-preview {
      height: 200px;
    }
    .card {
      max-width: 100%;
      padding: 15px 15px;
    }
    .banner {
      max-height: 180px;
    }
    .banner img {
      max-height: 180px;
    }
  }
  @media (max-width: 400px) {
    .card-preview {
      height: 160px;
    }
    .card-pdf a {
      font-size: 0.9rem;
      padding: 8px 14px;
    }
    header h1 {
      font-size: 1.5rem;
    }
    .banner {
      max-height: 140px;
    }
    .banner img {
      max-height: 140px;
    }
  }
</style>
</head>
<body>

<nav class="navbar">
  <div class="logo"></div>
  <button class="menu-toggle" id="menuToggle">&#9776;</button>
  <div class="sidebar" id="sidebar">
    <ul class="menu">
      <li>
        <a href="../index.html">A Cáritas</a>
        <ul class="submenu">
          <li><a href="../html/historia.html">História</a></li>
          <li><a href="../html/missao.html">Missão</a></li>
          <li><a href="../html/valores.html">Valores</a></li>
          <li><a href="../html/principios.html">Princípios Norteadores</a></li>
          <li><a href="../html/caritasmundo.html">Cáritas mundo</a></li>
          <li><a href="../html/parceiros.html">Parceiros</a></li>
        </ul>
      </li>
      <li><a href="../html/atuação.html">Atuação</a></li>
      <li>
        <a href="../html/voluntario.html">Como Apoiar</a>
        <ul class="submenu">
          <li><a href="../html/voluntario.html">Seja um voluntário</a></li>
          <li><a href="../html/nossascampanhas.html">Nossas campanhas</a></li>
          <li><a href="../html/basarcaritas.html">Bazar Cáritas</a></li>
        </ul>
      </li>
      <li>
        <a href="#">Fique por Dentro</a>
        <ul class="submenu">
          <li><a href="exibir_noticia.php">Notícias</a></li>
          <li><a href="exibir_editais.php";;>Editais e vagas</a></li>
          <li><a href="../html/transparencia.html">Transparência</a></li>
        </ul>
      </li>
      <li><a href="../html/contato.html">Contato</a></li>
      <li><a href="../html/doe.html">Doe</a></li>
    </ul>
  </div>
</nav>
<div class="overlay" id="overlay"></div>
<script src="../js/script.js"></script>

<div class="banner">
  <img src="../img/Banners_Editais.png" alt="Banner Editais" />
</div>

<div class="container">
  <header>
    <img src="../img/LOGOTIPO_CÁRITAS_HORIZONTAL_FUNDO_CLARO.png" alt="Logo Cáritas Campo Limpo" />
    <h1>Editais e Vagas</h1>
  </header>

  <p class="intro">
Aqui você encontra editais e vagas para atuar na Cáritas Campo Limpo que tem como diretriz geral de ação a construção solidária, sustentável e territorial de um projeto popular de sociedade democrática e de direitos. Entre os princípios está a defesa e promoção da vida para a construção da sociedade do Bem Viver; a cultura de solidariedade transformadora: fortalecer o protagonismo das pessoas em situação de vulnerabilidade, de risco e/ou exclusão social, entre outros...
  </p>

  <section class="cards-lista">
    <?php if ($result && $result->num_rows > 0): ?>
      <?php while ($edital = $result->fetch_assoc()): ?>
        <article class="card">
          <div class="card-titulo"><?= htmlspecialchars($edital['titulo']) ?></div>
          <div class="card-meta"><strong>Ano:</strong> <?= htmlspecialchars($edital['ano']) ?></div>
          <div class="card-tipo"><strong>Tipo:</strong> <?= htmlspecialchars($edital['tipo']) ?></div>

          <div class="card-preview">
            <iframe src="../admin/<?= htmlspecialchars($edital['pdf']) ?>"></iframe>
          </div>

          <div class="card-pdf">
            <a href="../admin/<?= htmlspecialchars($edital['pdf']) ?>" target="_blank" rel="noopener noreferrer">Abrir PDF em nova aba</a>
          </div>
        </article>
      <?php endwhile; ?>
    <?php else: ?>
      <p style="text-align:center; color:#999;">Nenhum edital disponível no momento.</p>
    <?php endif; ?>
  </section>
</div>

</body>
</html>
