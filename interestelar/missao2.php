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
    <h1>Qual é o planeta conhecido como estrela d’alva, visível ao amanhecer?</h1>
    <h4>Ao pousar em Vênus, você encontra uma porta dourada com inscrições antigas. Para destrancá-la, você deve responder corretamente à pergunta dos antigos exploradores</h4>
     <form class="resposta" method="POST">
        <input type="text" name="texto" required>
        <button class="neon" type="submit">Enviar</button>
    </form>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $planeta = strtolower(trim($_POST['texto']));

    if ($planeta === 'vênus' || $planeta === 'venus') {
        echo "<h2>Correto! Vênus é conhecido como estrela d’alva.</h2>";
    } else {
        echo "<h2>Resposta incorreta. Tente novamente!</h2>";
    }
}
    ?>
  
  </main>
</body>
</html>





