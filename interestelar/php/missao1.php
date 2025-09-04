<?php
session_start();

// Define a fase atual do usuário, se ainda não existir
if (!isset($_SESSION['fase_atual'])) {
    $_SESSION['fase_atual'] = 1;
}

// Bloqueia acesso se a fase atual for menor que esta missão
$fase_atual_pagina = 1; // Missão 1
if ($_SESSION['fase_atual'] < $fase_atual_pagina) {
    header("Location: missao" . $_SESSION['fase_atual'] . ".php");
    exit;
}

// Inicializa pontuação se ainda não existir
if (!isset($_SESSION['pontos'])) {
    $_SESSION['pontos'] = 0;
}
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <link rel="stylesheet" href="../missao.css" />
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

  <div class="pontuacao">
    Pontuação atual = <span id="pontos"><?php echo $_SESSION['pontos']; ?></span>
  </div>

  <main class="conteudo">
    <h1>Sua nave acabou de aterrissar em um planeta desconhecido. Para explorar este novo mundo, você precisa desvendar os enigmas deixados pelos antigos habitantes. Cada resposta correta abrirá portas e revelará segredos do cosmos. Está pronto para o desafio?</h1>
    <h4>Informe um número par, para liberar a informação sobre o planeta mais próximo do Sol</h4>

    <form class="resposta" method="POST">
      <input type="number" name="numero" required> <br><br>
      <button class="neon" type="submit">Enviar</button>
    </form>

        <h2>Sua nave acabou de aterrissar em um planeta desconhecido. Para explorar este novo mundo, você precisa desvendar os enigmas deixados pelos antigos habitantes. Cada resposta correta abrirá portas e revelará segredos do cosmos. Está pronto para o desafio?</h2>


    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $numero = $_POST['numero'];

        if ($numero % 2 == 0) {
            echo "<h2 style='color: green;'>✅ Mercúrio é o planeta mais próximo do Sol.</h2>";

            // Adiciona 5 pontos
            $_SESSION['pontos'] += 5;

            echo "<p>🎯 Você ganhou +5 pontos! Pontuação atual: " . $_SESSION['pontos'] . "</p>";

            // Desbloqueia a próxima fase
            $_SESSION['fase_atual'] = max($_SESSION['fase_atual'], 2);

            // Redireciona para a próxima missão após 2 segundos
            echo "<script>
                setTimeout(() => {
                    window.location.href = 'missao2.php';
                }, 2000);
            </script>";
        } else {
            echo "<h2 style='color: red;'>❌ Por favor, insira um número par.</h2>";
        }
    }
    ?>
  </main>

  <!-- 🚀 Tela de transição -->
  <div id="transition">
    <img src="../../img/foguete.png" alt="Foguete" class="rocket">
    <img src="../../img/nebulosa.webp" alt="Terra" class="earth">
  </div>

  <script src="../script/script.js"></script>

  <audio id="rocket-sound" src="foguete.mp3" preload="auto"></audio>
  <audio id="space-sound" src="espaço.mp3" preload="auto" loop></audio>
</body>
</html>
