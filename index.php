<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    

  <canvas id="starfield"></canvas>

  <!-- Conteúdo por cima do fundo animado -->
  <div class="Titulo1">
    <h1>🌎 Seja bem vindo ao desafio!!!</h1>
    <p>Entre na nave para começar</p>

<a href="interestelar/missao1.php"><button>Entrar</button></a>

    <a href="mais-informacoes.html"><button>Mais informações</button></a>
  </div>

  <script src="script.js"></script>


<?php
	spl_autoload_register(function($class) {
		$file = __DIR__ . "/interestelar/" . $class . ".php";
		if (file_exists($file)) require_once $file;
	});















    
?>
    
</body>
</html>