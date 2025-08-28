<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <link rel="stylesheet" href="missao.css" />
  <title>Fundo Galáxia (CSS-only)</title>
</head>
<body>
  <div class="galaxia">
    <div class="camada nebulosa"></div>
    <div class="camada espiral"></div>
    <div class="camada estrelas estrelas-a"></div>
    <div class="camada estrelas estrelas-b"></div>
    <div class="camada estrelas estrelas-c"></div>
    <div class="camada brilho"></div>
  </div>

  <!-- seu conteúdo por cima do fundo -->
  <main class="conteudo">
    <h1>Organize os planetas gasosos em ordem alfabética: Júpiter, Netuno, Saturno, Urano.</h1>
    <h3></h3>
     <form class="resposta" method="POST">
        <input type="number" name="numero" required>
        <button class="neon" type="submit">Enviar</button>
    </form>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $respostaUsuario = strtolower(trim($_POST['resposta'])); // valor que o usuário digitou
    $respostaCorreta = "júpiter, netuno, saturno, urano";

    if ($respostaUsuario == $respostaCorreta) {
        echo "<h2>Resposta correta, Parabéns !!</h2>";
    } else {
        echo "<h2>Resposta incorreta. Tente novamente!</h2>";
    }
  }
    ?>
  
  </main>
  
</body>
</html>