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

} ?>
