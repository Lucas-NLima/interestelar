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
        <input type="text" name="resposta" required>
        <button class="neon" type="submit">Enviar</button>
    </form>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $respostaUsuario = strtolower(trim($_POST['resposta'])); // valor que o usuário digitou
    $respostaCorreta = "júpiter, netuno, saturno, urano";

    if ($respostaUsuario == $respostaCorreta) {
        echo "<h2 style='color: green;'>✅ Resposta correta, Parabéns !!</h2>";
        echo"<a href='minijogo.html'><button class='neon'>Jogar Mini Jogo</button></a>";
        echo "Para atirar use a barra de espaço ou clique com o mouse(não é obrigatório) jogar";
    } else {
        echo "<h2 style = 'color : red;'>❌ Resposta incorreta. Tente novamente!</h2>";
    }
  }
    ?>
  
  </main>

  


  
</body>
</html>