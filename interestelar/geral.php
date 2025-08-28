<?php

 class Geral {

public function missao1($numeroPar) {
    if ($numeroPar % 2 == 0) {
        return "Mercúrio é o planeta mais próximo do Sol.";
    } else {
        return "Por favor, insira um número par.";
} }

public function missao2($planeta) {
    $planeta = strtolower(trim($planeta));
    if ($planeta === 'vênus' || $planeta === 'venus') {
        return "Correto! Vênus é conhecido como estrela d’alva.";
    } else {
        return "Resposta incorreta. Tente novamente!";
    }
}

public function missao3($senha) {
    if ($senha == 3) {
        return "Acesso liberado! Bem-vindo ao sistema.";
    } else {
        return "Senha incorreta. Tente novamente!";
    }
}

public function missao4($litrosOxi, $litrosAgua) {
    $custoOxi = 4; // Custo por litro de oxigênio
    $custoAgua = 2; // Custo por litro de água

    $totalOxi = $litrosOxi * $custoOxi;
    $totalAgua = $litrosAgua * $custoAgua;

    $gastoTotal = $totalOxi + $totalAgua;

    return "O gasto total foi: R$ " . number_format($gastoTotal, 2, ',', '.');
}

public function missao5($respostaUsuario) {
    $respostaUsuario = strtolower(trim($respostaUsuario));
    $respostaCorreta = "júpiter, netuno, saturno, urano";

    if ($respostaUsuario == $respostaCorreta) {
        return "Resposta correta, Parabéns !!";
    } else {
        return "Resposta incorreta. Tente novamente!";
    }
}

} ?>
