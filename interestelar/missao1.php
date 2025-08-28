<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <link rel="stylesheet" href="missao.css" />
  <title>Missão Galáxia</title>
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

  <main class="conteudo">
    <h1>Informe um número par, para liberar a informação sobre o planeta mais próximo do Sol</h1>
    <h4>Sua nave acabou de aterrissar em um planeta desconhecido. Para explorar este novo mundo, você precisa desvendar os enigmas deixados pelos antigos habitantes. Cada resposta correta abrirá portas e revelará segredos do cosmos. Está pronto para o desafio?</h4>

    <form class="resposta" method="POST">
      <input type="number" name="numero" required>
      <button class="neon" type="submit">Enviar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $numero = $_POST['numero'];

        if ($numero % 2 == 0) {
            echo "<h2 style='color: green;'>✅ Mercúrio é o planeta mais próximo do Sol.</h2>";
            
            // dispara a animação via JS
            echo "<script>
              setTimeout(() => {
                startTransition();
              }, 500);
            </script>";
        } else {
            echo "<h2 style='color: red;'>❌ Por favor, insira um número par.</h2>";
        }
    }
    ?>
  </main>

  <!-- 🚀 Tela de transição -->
  <div id="transition">
    <img src="../img/foguete.png" alt="Foguete" class="rocket">
    <img src="../img/nebulosa.webp" alt="Terra" class="earth">
  </div>

  <script src="script.js"></script>

  <audio id="rocket-sound" src="foguete.mp3" preload="auto"></audio>
<audio id="space-sound" src="espaço.mp3" preload="auto" loop></audio>


</body>
</html>
