<?php
session_start();

// Define a fase atual do usuário, se ainda não existir
if (!isset($_SESSION['fase_atual'])) {
    $_SESSION['fase_atual'] = 1;
}

// Bloqueia acesso se a fase atual for menor que esta missão
$fase_atual_pagina = 2; // Missão 2
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

  <div class="pontuacao">
    Pontuação atual = <span id="pontos"><?php echo $_SESSION['pontos']; ?></span>
  </div>

  <main class="conteudo">
    
  <h1>Explore os mistérios do cosmos e continue sua jornada. Cada resposta correta desbloqueia novas descobertas.</h1>

   <h2>Informe o nome do planeta que é conhecido como o “Planeta Vermelho”</h2>


 <form class="resposta" method="POST">
      <input type="text" name="planeta" required> <br><br>
      <button class="neon" type="submit">Enviar</button>
 </form>


    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $planeta = strtolower(trim($_POST['planeta']));

        // Resposta correta: "marte"
        if ($planeta === "marte") {
            echo "<h2 style='color: green;'>✅ Marte é o Planeta Vermelho.</h2>";

            // Adiciona 5 pontos
            $_SESSION['pontos'] += 5;

            echo "<p>🎯 Você ganhou +5 pontos! Pontuação atual: " . $_SESSION['pontos'] . "</p>";

            // Desbloqueia a próxima fase
            $_SESSION['fase_atual'] = max($_SESSION['fase_atual'], 3);

            // Redireciona para a próxima missão após 2 segundos
            echo "<script>
              setTimeout(() => {
                startTransition();
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
    <img src="../../img/foguete.png" alt="Foguete" class="rocket">
    <img src="../../img/venus.png" alt="Terra" class="earth">
  </div>
  
  <script src="../script/script2.js"></script>

  
 <audio id="rocket-sound" src="../som/foguete.mp3" preload="auto"></audio>
  <audio id="space-sound" src="../som/espaço.mp3" preload="auto" loop></audio>
</body>
</html>
