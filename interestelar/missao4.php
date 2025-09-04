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
$fase_atual_pagina = 4; // Missão 4
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
  <title>Missão Galáxia - Missão 4</title>
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
    <h1>Um robô em Marte consumiu 3 litros de oxigênio (R$4 cada) e 2 litros de água (R$2 cada). Qual foi o gasto total?</h1>
    <h3>Após deixar a Terra, sua nave atravessa o espaço e chega a Marte, o enigmático planeta vermelho. Frio e árido, ele guarda desertos imensos e o Monte Olimpo, a maior montanha do Sistema Solar. Agora, seus enigmas estarão ligados à exploração espacial e aos mistérios deste vizinho da Terra.</h3>

    <form class="resposta" method="POST">
      <input type="number" name="total" required>
      <button class="neon" type="submit">Enviar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $respostaUsuario = $_POST['total'];

        $litrosOxi = 3;
        $valorOxi = 4;
        $litrosAgua = 2;
        $valorAgua = 2;

        $respostaCorreta = ($litrosOxi * $valorOxi) + ($litrosAgua * $valorAgua); // 16

        if ($respostaUsuario == $respostaCorreta) {
            echo "<h2 style='color: green;'>✅ Resposta correta, Parabéns!</h2>";

            // Adiciona 5 pontos
            $_SESSION['pontos'] += 5;
            echo "<p>🎯 Você ganhou +5 pontos! Pontuação atual: " . $_SESSION['pontos'] . "</p>";

            // Desbloqueia a próxima fase
            $_SESSION['fase_atual'] = max($_SESSION['fase_atual'], 5);

            // Redireciona para a próxima missão após 2 segundos
            echo "<script>
                setTimeout(() => {
                    window.location.href = 'missao5.php';
                }, 2000);
            </script>";
        } else {
            echo "<h2 style='color: red;'>❌ Resposta incorreta. Tente novamente!</h2>";
        }
    }
    ?>
  </main>

  <!-- 🚀 Tela de transição -->
  <div id="transition">
    <img src="../img/foguete.png" alt="Foguete" class="rocket">
    <img src="../img/marte.png" alt="Marte" class="earth">
  </div>

  <script src="script4.js"></script>
  <audio id="rocket-sound" src="foguete.mp3" preload="auto"></audio>
  <audio id="space-sound" src="espaço.mp3" preload="auto" loop></audio>
</body>
</html>
