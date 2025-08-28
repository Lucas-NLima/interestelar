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
    <h1>A senha é a posição da Terra no Sistema Solar (contando a partir do Sol)</h1>
    <h4>A Terra, conhecida como o planeta azul, é o único que abriga vida, com oceanos, florestas e uma atmosfera rica em oxigênio. Lar da humanidade e de milhões de espécies, desafia os viajantes com enigmas que exigem raciocínio lógico e atenção aos detalhes para avançar na missão.</h4>
     <form class="resposta" method="POST">
        <input type="number" name="senha" required>
        <button class="neon" type="submit">Enviar</button>
    </form>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $senha = $_POST['senha'];

    if ($senha == 3) {
        echo "<h2 style = 'color : green;'>Acesso liberado! Bem-vindo ao sistema.</h2>";
        echo"<button class = 'neon'><a href='missao4.php'>Próxima missão</a></button>";
    } else {
        echo "<h2 style = 'color : red;'>❌ Senha incorreta. Tente novamente!</h2>";
    }
}
    ?>
  
  </main>
  
</body>
</html>