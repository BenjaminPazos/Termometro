<?php

$palavra = "TEMPO";
$letras = str_split($palavra);
$jogando = false;
print_r($letras);
do {
    $chute = readline("Escreva seu chute: ");
    $letrasChute = str_split($chute);
    print_r($letrasChute);

    if (strtoupper($chute) == $palavra) {
        echo "acertou \n";
        $jogando = true;
    }

    if (strtoupper($letrasChute[0]) == strtoupper($letras[0])) {
        echo "T na posição certa!\n";
    } else if(in_array($letrasChute[0], $letras)) {
        echo "Tem T na palavra! \n";
    }

    if (strtoupper($letrasChute[1]) == strtoupper($letras[1])) {
        echo  "E na posição certa!\n";
    } else if (in_array($letrasChute[1], $letras)) {
        echo "Tem E na palavra! \n";
    }

    if (strtoupper($letrasChute[2]) == strtoupper($letras[2])) {
        echo "M na posição certa!\n";
    } else if (in_array($letrasChute[2], $letras)) {
        echo "Tem M na palavra! \n";
    }

    if (strtoupper($letrasChute[3]) == strtoupper($letras[3])) {
        echo "P na posição certa!\n";
    } else if (in_array($letrasChute[3], $letras)) {
        echo "Tem P na palavra! \n";
    }

    if (strtoupper($letrasChute[4]) == strtoupper($letras[4])) {
        echo "O na posição certa!\n";
    } else if (in_array($letrasChute[4], $letras)) {
        echo "Tem O na palavra! \n";
    }
} while ($jogando == false);
