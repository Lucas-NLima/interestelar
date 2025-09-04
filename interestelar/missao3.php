<?php
session_start();

// Inicializa a fase atual e pontuação, se não existir
if (!isset($_SESSION['fase_atual'])) {
    $_SESSION['fase_atual'] = 1;
}
if (!isset($_SESSION['pontos'])) {
    $_SESSION['pontos'] = 0;
}

// Bloqueia acesso se a fase atual for menor que esta missão
$fase_atual_pagina = 3; // Missão 3
if ($_SESSION['fase_atual'] < $fase_atual_pagina) {
    header("Location: missao" . $_SESSION['fase_atual'] . ".php");
    exit;
}
?>
<!doctype html>
<html lang="pt-br">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <link rel="stylesheet" href="missao.css" />
  <title>Missão Galáxia - Missão 3</title>
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
    <h1>A senha é a posição da Terra no Sistema Solar (contando a partir do Sol)</h1>
    <h4>A Terra, conhecida como o planeta azul, é o único que abriga vida, com oceanos, florestas e uma atmosfera rica em oxigênio. Desafie-se para avançar na missão.</h4>

    <form class="resposta" method="POST">
      <input type="number" name="senha" required>
      <button class="neon" type="submit">Enviar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $senha = $_POST['senha'];

        if ($senha == 3) { // resposta correta
            echo "<h2 style='color: green;'>✅ Acesso liberado! Bem-vindo ao sistema.</h2>";

            // Adiciona 5 pontos
            $_SESSION['pontos'] += 5;
            echo "<p>🎯 Você ganhou +5 pontos! Pontuação atual: " . $_SESSION['pontos'] . "</p>";

            // Desbloqueia a próxima fase
            $_SESSION['fase_atual'] = max($_SESSION['fase_atual'], 4);

            // Redireciona para a próxima missão após 2 segundos
            echo "<script>
                setTimeout(() => {
                    window.location.href = 'missao4.php';
                }, 2000);
            </script>";
        } else {
            echo "<h2 style='color: red;'>❌ Senha incorreta. Tente novamente!</h2>";
        }
    }
    ?>
  </main>

  <!-- 🚀 Tela de transição -->
  <div id="transition">
    <img src="../img/foguete.png" alt="Foguete" class="rocket">
    <img src="../img/terra.png" alt="Terra" class="earth">
  </div>

  <script src="script3.js"></script>

  <audio id="rocket-sound" src="foguete.mp3" preload="auto"></audio>
  <audio id="space-sound" src="espaço.mp3" preload="auto" loop></audio>
</body>
</html>
