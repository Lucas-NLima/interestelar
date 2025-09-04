<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="..//css-inicio/style.css">
</head>
<body>
    

  <canvas id="starfield"></canvas>

  <!-- Conteúdo por cima do fundo animado -->
  <div class="Titulo1">
    <h1>Interestelar</h1>
    <h2 class="h2" >e os</h2>
    <h2 class="h2"> Mistérios do sistema solar!!!</h2>
    <p class="h2">Entre na nave para começar</p>

<a href="../interestelar/php/missao1.php"><button class="but">Iniciar...</button></a>

    <a href="mais-informacoes.html"><button class="but">Mais informações</button></a>
  </div>

  <script src="..//script-inicio/script.js"></script>
<?php
	spl_autoload_register(function($class) {
		$file = __DIR__ . "/interestelar/" . $class . ".php";
		if (file_exists($file)) require_once $file;
	});















    
?>



    
</body>
</html>