<?php

//Herança, Associação e Interface
//Menu, Pesquisa, Imprimir os Dados, Interação com Usuário 

do {
    echo "\nTermometro\n";
    echo "\n";
    echo "(1) Jogos \n";
    echo "(0) Sair\n";
    echo "\n";
    $resposta = readline("Opção: ");
    switch ($resposta) {
        case '1':
            echo "\e[H\e[J";
            do {
                echo "\nModos de Jogo \n";
                echo "\n";
                echo "(1) Termometro \n";
                echo "(2) Durmometro \n";
                echo "(3) Quartometro \n";
                echo "(0) Sair \n";
                echo "\n";
                $resposta2 = readline("Opção: ");
                switch ($resposta2) {
                    case '1':
                        
                        break;
                    case '0':
                        echo "Saindo...";
                        echo "\e[H\e[J";
                        break;
                    default:
                        echo "Opção inválida \n";
                        break;
                }
            } while ($resposta2 != 0);
            break;
        case '0':
            echo "Saindo...";
            break;
        default:
            echo "Opção inválida \n";
            break;
    }
} while ($resposta != 0);
