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
  Pontuação atual = <span id="pontos">20</span>
</div>

  <!-- seu conteúdo por cima do fundo -->
  <main class="conteudo">
    <h1>Um robô em Marte consumiu 3 litros de oxigênio (R$4 cada) e 2 litros de água (R$2 cada).
Qual foi o gasto total?</h1>
    <h3>Após deixar a Terra, sua nave atravessa o espaço e chega a Marte, o enigmático planeta vermelho. Frio e árido, ele guarda desertos imensos e o Monte Olimpo, a maior montanha do Sistema Solar. Agora, seus enigmas estarão ligados à exploração espacial e aos mistérios deste vizinho da Terra.</h3>
     <form class="resposta" method="POST">
        <input type="number" name="total" required>
        <button class="neon" type="submit">Enviar</button>
    </form>
    
    <?php
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $respostaUsuario = $_POST['total']; // valor que o usuário digitou

    $litrosOxi = 3;
    $valorOxi = 4;
    $litrosAgua = 2;
    $valorAgua = 2;

    $totalOxi = $litrosOxi * $valorOxi;
    $totalAgua = $litrosAgua * $valorAgua;

    $respostaCorreta = $totalOxi + $totalAgua; // resultado certo = 16

    if ($respostaUsuario == $respostaCorreta) {
        echo "<h2 style = 'color : green;'>✅ Resposta correta, Parabéns !!</h2>";
        echo "<p>🎯 Você ganhou +5 pontos!";
         // dispara a animação via JS
            echo "<script>
              setTimeout(() => {
                startTransition(); 
              }, 500);
            </script>";
    } else {
        echo "<h2 style = 'color : red;'>❌ Senha incorreta. Tente novamente!</h2>";
    }
}
    ?>
  
  </main>
       <!-- 🚀 Tela de transição -->
   <div id="transition">
    <img src="../../img/foguete.png" alt="Foguete" class="rocket">
    <img src="../../img/marte.png" alt="Terra" class="earth">
  </div>
  
  <script src="../script/script4.js"></script>

  
  <audio id="rocket-sound" src="foguete.mp3" preload="auto"></audio>
<audio id="space-sound" src="espaço.mp3" preload="auto" loop></audio>

  
</body>
</html>