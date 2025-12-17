
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(120deg, #FFA500, #FF6F00);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-container {
      background-color: #fff;
      padding: 40px 30px  ;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 500px;
    }

    .login-container h2 {
      text-align: center;
      margin-bottom: 25px;
    }

    .login-container input {
      width: 90%;
      padding: 13px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
    }

    .login-container button {
      width: 97%;
      padding: 12px;
      background-color: #FF6F00;
      border: none;
      border-radius: 8px;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
    }


  </style>
</head>
<body>
  <div class="login-container">
    <h2>Login</h2>
    <form action="autenticar.php" method="post">
      <input type="email" name="email" placeholder="E-mail" required>
      <input type="password" name="senha" placeholder="Senha" required>
      <button type="submit">Entrar</button>
    </form>
    <?php
    if (isset($_GET['erro'])) {
      echo "<p style='color: red; text-align: center;'>Usuário ou senha inválidos</p>";
    }
    ?>
  </div>
</body>
</html>
