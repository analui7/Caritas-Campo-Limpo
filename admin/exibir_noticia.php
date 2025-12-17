<?php
include('../admin/conexao.php');

// Buscar notícias mais recentes primeiro
$sql = "SELECT * FROM noticias ORDER BY data DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8" />
<title>Notícias - Cáritas Campo Limpo</title>
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

  .cards-lista {
    max-width: 900px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit,minmax(280px,1fr));
    gap: 30px;
  }

  .cards-card {
    background: #FFF6ED;
    padding: 25px 30px;
    border-radius: 15px;
    box-shadow: 0 6px 15px rgba(244, 122, 53, 0.15);
    display: flex;
    flex-direction: column;
    transition: transform 0.3s ease;
    max-width: 800px;
    margin: 0 auto;
  }

  .cards-card:hover {
    transform: translateY(-7px);
  }

  .noticia-assunto {
    font-weight: 700;
    font-size: 1.3rem;
    color: #F47A35;
    margin-bottom: 8px;
  }

  .noticia-meta {
    font-size: 0.9rem;
    color: #777;
    margin-bottom: 10px;
  }

  .noticia-projeto,
  .noticia-area {
    font-weight: 600;
    font-size: 1rem;
    color: #d35400;
    margin-bottom: 8px;
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

  .banner {
    width: 100%;
    max-height: 300px;
    margin-bottom: 30px;
    background-color: #F47A35;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
  }

  .banner img {
    width: 100%;
    height: auto;
    object-fit: cover;
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
  }

  @media(max-width:600px) {
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
          <li><a href="exibir_editais.php">Editais e vagas</a></li>
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

<!-- Espaço para banner -->
<div class="banner">
  <img src="../img/Banners_noticia.png" alt="Banner Notícias" />
</div>

<div class="container">
  <header>
    <img src="../img/LOGOTIPO_CÁRITAS_HORIZONTAL_FUNDO_CLARO.png" alt="Logo Cáritas Campo Limpo" />
    <h1>Nossas notícias</h1>
  </header>

  <p class="intro">
Aqui você acompanha de perto tudo o que acontece na Cáritas Campo Limpo. Este é o lugar onde compartilhamos as ações, projetos e iniciativas que transformam vidas nas unidades onde atuamos.
Por meio de reportagens, registros fotográficos e relatos inspiradores, você poderá conhecer o impacto do nosso trabalho nas diferentes unidades e áreas de atuação. Cada história aqui publicada reflete o compromisso com a dignidade humana, a solidariedade e a promoção da justiça social.
Navegue, descubra e inspire-se com as notícias que mostram o dia a dia de uma rede viva e atuante, feita por pessoas que acreditam em um mundo mais justo e fraterno.
  </p>

  <section class="cards-lista">
    <?php if ($result && $result->num_rows > 0): ?>
      <?php while ($n = $result->fetch_assoc()): ?>
        <article class="cards-card">
          <div class="noticia-assunto"><?= htmlspecialchars($n['assunto']) ?></div>
          <div class="noticia-meta"><?= date('d/m/Y', strtotime($n['data'])) ?></div>
          <div class="noticia-projeto">Projeto: <?= htmlspecialchars($n['projetos']) ?></div>
          <div class="noticia-area">Área: <?= htmlspecialchars($n['area']) ?></div>

          <div class="card-preview">
            <iframe src="../admin/<?= htmlspecialchars($n['pdf']) ?>"></iframe>
          </div>

          <div class="card-pdf">
            <a href="../admin/<?= htmlspecialchars($n['pdf']) ?>" target="_blank" rel="noopener noreferrer">Abrir PDF em nova aba</a>
          </div>
        </article>
      <?php endwhile; ?>
    <?php else: ?>
      <p style="text-align:center; color:#999;">Nenhuma notícia disponível no momento.</p>
    <?php endif; ?>
  </section>
</div>

</body>
</html>
