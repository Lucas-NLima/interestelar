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
    <h1>Organize os planetas gasosos em ordem alfabética:</h1>
    <form class="resposta" method="POST">
        <label>
            <input type="radio" name="resposta" value="júpiter, netuno, saturno, urano" required>
            Júpiter, Netuno, Saturno, Urano
        </label><br>

        <label>
            <input type="radio" name="resposta" value="júpiter, saturno, urano, netuno">
            Júpiter, Saturno, Urano, Netuno
        </label><br>

        <label>
            <input type="radio" name="resposta" value="netuno, saturno, urano, júpiter">
            Netuno, Saturno, Urano, Júpiter
        </label><br>

        <label>
            <input type="radio" name="resposta" value="netuno, urano, júpiter, saturno">
            Netuno, Urano, Júpiter, Saturno
        </label><br>

        <button class="neon" type="submit">Enviar</button>
    </form>
    </body>
</html>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $respostaUsuario = strtolower(trim($_POST['resposta']));
        $respostaCorreta = "júpiter, netuno, saturno, urano"; // ordem correta

    if ($respostaUsuario == $respostaCorreta) {
        echo "<h2 style='color: green;'>✅ Resposta correta, Parabéns !!</h2>";
        echo "<p>🎯 Você ganhou +5 pontos!";
        echo "<p>🥳 Sua pontuação final foi de 25 pontos !!";
        echo "<h3 style = 'color: gold;'> Você desbloqueou o mini jogo!</h3> . '<br>' ";
        echo"<a href='minijogo.html'><button class='neon'>Jogar Mini Jogo</button></a>. <br>";
        echo "Para atirar use a barra de espaço e para se movimentar as setas (não é obrigatório jogar)  . '<br>' ";
        echo "<table border='1' style = 'color: gold;'>
        <th>Instrução</th>
        <tr>
        <td> 🛡️ = shild(invencibilidade)</td>
         </tr>

        <tr>
        <td> ❤️ = vida extra </td>
        </tr>

        <tr>
        <td> ✨ (verde) = velocidade de tiro </td>
        </tr>

        <tr>
        <td> ✨ (azul) = tiros triplos </td>
        </tr>
       
        </table>";
    } else {
        echo "<h2 style = 'color : red;'>❌ Resposta incorreta. Tente novamente!</h2>";
    }
  }
    ?>
</main>
