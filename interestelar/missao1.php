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
    <h1>Informe um número par, para liberar a informação sobre o planeta mais próximo do Sol</h1>
    <h4>Sua nave acabou de aterrissar em um planeta desconhecido. Para explorar este novo mundo, você precisa desvendar o enigmas deixados pelos antigos habitantes. Cada resposta correta abrirá portas e revelará segredos do cosmos. Está pronto para o desafio?.</h4>
     <form class="resposta" method="POST">
        <input type="number" name="numero" required>
        <button class="neon" type="submit">Enviar</button>
    </form>
    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero = $_POST['numero'];

    if ($numero % 2 == 0) {
        echo "<h2 style = 'color : green;'>Mercúrio é o planeta mais próximo do Sol.</h2>";
        echo"<button class = 'neon'><a href='missao2.php'>Próxima missão</a></button>";
    } else {
        echo "<h2 style = 'color : red;'>❌ Por favor, insira um número par.</h2>";
    }


} ?>
  
  </main>
  
</body>
</html>





