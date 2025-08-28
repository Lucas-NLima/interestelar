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
    <h4>Ao  você encontra uma porta dourada com inscrições antigas. Para destrancá-la, você deve responder corretamente à pergunta dos antigos exploradores</h4>
     <form class="resposta" method="POST">
        <input type="text" name="texto" required>
        <button class="neon" type="submit">Enviar</button>
    </form>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $planeta = strtolower(trim($_POST['texto']));

    if ($planeta === 'vênus' || $planeta === 'venus') {
        echo "<h2 style = 'color : green;'>✅ Correto! Vênus é conhecido como estrela d’alva.</h2>";;
         // dispara a animação via JS
            echo "<script>
              setTimeout(() => {
                startTransition();
              }, 500);
            </script>";
    } else {
        echo "<h2 style = 'color : red;'>❌ Resposta incorreta. Tente novamente! (34690)</h2>";
        echo "<table border='1'>
        <th>Enigma</th>
        <tr>
        <td> 1 = A </td>
        <td> 2 = C </td>
        <td> 3 = V </td>
        <td> 4 = E </td>
        </tr>
        <tr>
        <td> 5 = F </td>
        <td> 6 = N </td>
        <td> 7 = Y </td>
        <td> 8 = P </td>
        </tr>
        <tr>
        <td> 9 = U </td>
        <td> 0 = S </td>
        <td> 10 = X </td>
        <td> 11 = B </td>
        </table>";
        
} 

     }
    ?>
  
  </main>

    <!-- 🚀 Tela de transição -->
  <div id="transition">
    <img src="../img/foguete.png" alt="Foguete" class="rocket">
    <img src="../img/venus.png" alt="Terra" class="earth">
  </div>
  
  <script src="script2.js"></script>


</body>
</html>





