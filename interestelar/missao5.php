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

        if ($respostaUsuario === $respostaCorreta) {
            echo "<h3 style='color:green;'>✅ Correto! A ordem alfabética é: Júpiter, Netuno, Saturno, Urano.</h3>";
        } else {
            echo "<h3 style='color:red;'>❌ Incorreto. Tente novamente!</h3>";
        }
    }
    ?>
</main>
