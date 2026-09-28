<?php

require_once("modelo/Termo.php");
require_once("modelo/Dueto.php");
require_once("modelo/Quarteto.php");
require_once("modelo/Partida.php");


// function verificarPalavra(array $letrasChute, array $letras, array $cores)
// {
//     for ($i = 0; $i < 5; $i++) {
//         if ($letrasChute[$i] == $letras[$i]) {
//             echo $cores["verde"] . "$letrasChute[$i] na posição certa!\n" . $cores["reset"]; // volta pra cor padrao
//         } else if (in_array($letrasChute[$i], $letras)) {
//             echo $cores ["amarelo"] . "Tem $letrasChute[$i] na palavra!\n" . $cores["reset"];
//         } else {
//             echo "$letrasChute[$i] não tem na palavra \n";
//         }
//     }
// } Eu tinha feito assim antes mas decidi mudar depois pra usar com interface

// TDQ = Termo, Dueto, Quarteto
function TDQ(string $modoDeJogo, array $bibliotecaPalavras)
{


    // INFOS DO JOGO
    $acabou = false;
    $ganhou_perdeu = false;
    $termo = null;
    $dueto = null;
    $quarteto = null;
    $palavras = [];
    $palavrasCertas = [
        1 => false,
        2 => false,
        3 => false,
        4 => false
    ];
    $letras = [];
    // -------------

    // MECANICA DO JOGO

    // TERMO

    if ($modoDeJogo == "termo") {
        $indiceAleatorio = array_rand($bibliotecaPalavras);
        $palavras[] = $bibliotecaPalavras[$indiceAleatorio];
        $termo = new Termo($palavras);
        $letras = $termo->getLetras();
        $tentativas = 6;
    } else if ($modoDeJogo == "dueto") {

        // DUETO
        $indiceAleatorio = array_rand($bibliotecaPalavras, 2);
        foreach ($indiceAleatorio as $indice) {
            $palavras[] = $bibliotecaPalavras[$indice];
        }
        $dueto = new Dueto($palavras);
        $letras = $dueto->getLetras();
        $tentativas = 7;
    } else {

        // QUARTETO

        $indiceAleatorio = array_rand($bibliotecaPalavras, 4);
        foreach ($indiceAleatorio as $indice) {
            $palavras[] = $bibliotecaPalavras[$indice];
        }
        $quarteto = new Quarteto($palavras);
        $letras = $quarteto->getLetras();
        $tentativas = 9;
    }

    do {
        if ($tentativas == 0) {
            if ($modoDeJogo == "termo") {

                // TERMO


                echo "\nTentativas acabadas você perdeu, a palavra era: $palavras[0] \n";
                $acabou = true;
                $ganhou_perdeu = false;
                $partida = new Partida($ganhou_perdeu, (6 - $tentativas), $modoDeJogo);
                $termo->setPartida($partida);
                echo "\nPressione ENTER para voltar ao menu";
                readline();

                // tava dando muito erro pra apagar pq nenhum outro apagava so com esse eu consegui apagar todo o terminal
                echo "\033[2J\033[3J\033[H";
                break;
            } else if ($modoDeJogo == "dueto") {

                // DUETO


                echo "\nTentativas acabadas você perdeu, as palavras eram: $palavras[0], $palavras[1] \n";
                $acabou = true;
                $ganhou_perdeu = false;
                $partida = new Partida($ganhou_perdeu, (7 - $tentativas), $modoDeJogo);
                $dueto->setPartida($partida);
                echo "\nPressione ENTER para voltar ao menu";
                readline();
                echo "\033[2J\033[3J\033[H";
                break;
            } else {
                // QUARTETO
                echo "\nTentativas acabadas você perdeu, as palavras eram: $palavras[0], $palavras[1], $palavras[2], $palavras[3] \n";
                $acabou = true;
                $ganhou_perdeu = false;
                $partida = new Partida($ganhou_perdeu, (9 - $tentativas), $modoDeJogo);
                $quarteto->setPartida($partida);
                echo "\nPressione ENTER para voltar ao menu";
                readline();
                echo "\033[2J\033[3J\033[H";
                break;
            }
        }
        echo "\nChutes Restantes: $tentativas \n";
        $chute = readline("Escreva seu chute: ");
        $chute = strtoupper($chute);
        $letrasChute = str_split($chute);

        if (strlen($chute) !== 5) {
            echo "\nA palavra precisa ter exatamente 5 letras!!\n";
            continue; // o continue ele basicamente pula uma rodada do loop, ele ignora o resto do codigo e vai pro proximo loop
        }

        $tentativas--;
        if ($modoDeJogo == "termo") {

            // TERMO

            if ($chute == $palavras[0]) {

                $acabou = true;
                $ganhou_perdeu = true;
                $partida = new Partida($ganhou_perdeu, (6 - $tentativas), $modoDeJogo);
                echo "\nParabéns você ganhou!!! \n";
                echo "Número de tentativas: " . $partida->getTentativas() .   "\n";
                $termo->setPartida($partida);
                echo "\nPressione ENTER para voltar ao menu";
                readline();
                echo "\033[2J\033[3J\033[H";

                break;
            }
        } else if ($modoDeJogo == "dueto") {

            // DUETO
            for ($i = 1; $i <= 2; $i++) {
                if ($chute == $palavras[$i - 1]) {
                    echo "\nAcertou a " . $i . "º palavra \n";
                    $palavrasCertas[$i] = true;
                }
            }
            if ($palavrasCertas["1"] and $palavrasCertas["2"]) {
                $acabou = true;
                $ganhou_perdeu = true;
                $partida = new Partida($ganhou_perdeu, (7 - $tentativas), $modoDeJogo);
                echo "\nParabéns você ganhou!!! \n";
                echo "Número de tentativas: " . $partida->getTentativas() .   "\n";
                $dueto->setPartida($partida);
                echo "\nPressione ENTER para voltar ao menu";
                readline();
                echo "\033[2J\033[3J\033[H";
                break;
            }
        } else {

            // QUARTETO

            for ($i = 1; $i <= 4; $i++) {
                if ($chute == $palavras[$i - 1]) {
                    echo "\nAcertou a " . $i . "º palavra \n";
                    $palavrasCertas[$i] = true;
                }
            }

            if ($palavrasCertas["1"] and $palavrasCertas["2"] and $palavrasCertas["3"] and $palavrasCertas["4"]) {
                $acabou = true;
                $ganhou_perdeu = true;
                $partida = new Partida($ganhou_perdeu, (9 - $tentativas), $modoDeJogo);
                echo "\nParabéns você ganhou!!! \n";
                echo "Número de tentativas: " . $partida->getTentativas() .   "\n";
                $quarteto->setPartida($partida);
                echo "\nPressione ENTER para voltar ao menu";
                readline();
                echo "\033[2J\033[3J\033[H";
                break;
            }
        }

        if ($modoDeJogo == "termo") {

            // TERMO

            $resultado = $termo->verificarPalavra($letrasChute, $letras);
            verificacao($resultado, $letrasChute);
        } else if ($modoDeJogo == "dueto") {

            // DUETO

            for ($i = 0; $i < 2; $i++) {
                if (!$palavrasCertas[$i + 1]) {
                    echo "\nPalavra " . ($i + 1) . ": \n";

                    $resultado = $dueto->verificarPalavra($letrasChute, $letras[$i]);
                    verificacao($resultado, $letrasChute);
                }
            }
        } else {

            // QUARTETO
            for ($i = 0; $i < 4; $i++) {
                if (!$palavrasCertas[$i + 1]) {
                    echo "\nPalavra " . ($i + 1) . ": \n";

                    $resultado = $quarteto->verificarPalavra($letrasChute, $letras[$i]);
                    verificacao($resultado, $letrasChute);
                }
            }
        }
    } while (!$acabou);
    if ($modoDeJogo == "termo") {

        // TERMO

        return $termo;
    } else if ($modoDeJogo == "dueto") {

        // DUETO

        return $dueto;
    } else {

        // QUARTETO
        return $quarteto;
    }

    // FIM MECANICA
}
function verificacao(array $resultado, array $letrasChute)
{
    // CORES
    $cores = [
        "amarelo" => "\033[33m",
        "verde" => "\033[32m",
        "reset" => "\033[0m" // é a cor padrão
    ];
    $i = 0;
    // -----
    foreach ($letrasChute as $l) {
        if ($resultado[$i] == "verde") {

            echo $cores["verde"] .  $l  . " na posição certa!\n" . $cores["reset"];
        } else if ($resultado[$i] == "amarelo") {

            echo $cores["amarelo"] . $l  . " na posição errada!\n" . $cores["reset"];
        } else {

            echo $cores["reset"] . $l  . " não tem na palavra!\n" . $cores["reset"];
        }
        $i++;
    }
    echo $cores["reset"];
}

// PROGAMA PRINCIPAL

// PALAVRAS
$bibliotecaPalavras = [
    "TEMPO",
    "BARCO",
    "NOITE",
    "VERDE",
    "CLARO",
    "PEDRA",
    "LIVRO",
    "MUNDO",
    "SONHO",
    "CHUVA",
    "VENTO",
    "BRISA",
    "NUVEM",
    "CAMPO",
    "FOLHA",
    "PLANO",
    "FRUTA",
    "CARNE",
    "TIGRE",
    "ZEBRA",
    "COBRA",
    "MOSCA",
    "AREIA",
    "MARTE",
    "ASTRO",
    "SOLAR",
    "RAIOS",
    "FOICE",
    "CHAVE",
    "TREVO",
    "GRAMA",
    "PRAIA",
    "PORTA",
    "MURAL",
    "TELHA",
    "BANCO",
    "FORMA",
    "VALOR",
    "IDEIA",
    "JUSTO",
    "FORTE",
    "BRAVO",
    "SABER",
    "PENSO",
    "FAZER",
    "DIZER",
    "OUVIR",
    "ANDAR",
    "PULAR",
    "VIVER",
    "COMER",
    "BEBER",
    "PEGAR",
    "JOGAR",
    "LUTAR",
    "AMIGO",
    "GRUPO",
    "ALUNO",
    "PROVA",
    "TURMA",
    "NOTAS",
    "MOUSE",
    "TECLA",
    "FONTE",
    "CABOS",
    "PLACA",
    "CHIPS",
    "DADOS",
    "FESTA",
    "SABOR",
    "LIMAO",
    "MANGA",
    "POMAR",
    "TRIGO",
    "MILHO",
    "ARROZ",
    "AIPIM",
    "BATOM",
    "PERNA",
    "OLHOS",
    "NARIZ",
    "DENTE",
    "UNHAS",
    "JOVEM",
    "IDOSO",
    "HOMEM",
    "FREIO",
    "PISTA",
    "CURVA",
    "RODAS",
    "METRO",
    "BARCA",
    "BICHO",
    "GANSO",
    "PANDA",
    "CORAL",
    "ALGAS",
    "ONDAS",
    "NORTE",
    "LESTE",
    "LUGAR",
    "VALES",
    "MONTE",
    "FAROL",
    "CANTO",
    "RITMO",
    "PIANO",
    "VIOLA",
    "SAMBA",
    "METAS",
    "SONDA",
    "SULCO",
    "FOLIA",
    "DANCA",
    "VINHO",
    "SUAVE",
    "AMIDO",
    "SALTO",
    "CORDA",
    "JOGOS",
    "REINO",
    "MAGIA",
    "VILAO",
    "ESPIA",
    "BANHO",
    "TERRA",
    "MELAO",
    "PENTE",
    "TALCO",
    "VIDRO",
    "FERRO",
    "PRATA",
    "METAL",
    "CAIXA",
    "PRECO",
    "FEIRA",
    "LOJAS",
    "PONTE",
    "TORRE",
    "PRAZO",
    "RISCO",
    "CRIME",
    "GRAVE",
    "LEGAL",
    "IGUAL",
    "OUTRO",
    "ALGUM",
    "CINCO",
    "DEZEM"
];
// --------

$historico = [];

do {
    echo "\n";
    echo "╔══════════════════════════════════╗\n";
    echo "║          T E R M O M E T R O     ║\n";
    echo "╠══════════════════════════════════╣\n";
    echo "║                                  ║\n";
    echo "║   [1]  Jogos                     ║\n";
    echo "║   [2]  Histórico                 ║\n";
    echo "║   [3]  Ajuda                     ║\n";
    echo "║   [0]  Sair                      ║\n";
    echo "║                                  ║\n";
    echo "╚══════════════════════════════════╝\n";
    echo "\n";
    $resposta = readline("Opção: ");
    switch ($resposta) {
        case '1':
            echo "\e[H\e[J";
            do {
                echo "\n";
                echo "╔══════════════════════════════════╗\n";
                echo "║          M O D O S  D E          ║\n";
                echo "║              J O G O             ║\n";
                echo "╠══════════════════════════════════╣\n";
                echo "║                                  ║\n";
                echo "║   [1]  Termo                     ║\n";
                echo "║   [2]  Dueto                     ║\n";
                echo "║   [3]  Quarteto                  ║\n";
                echo "║   [0]  Voltar                    ║\n";
                echo "║                                  ║\n";
                echo "╚══════════════════════════════════╝\n";
                echo "\n";
                $resposta2 = readline("Opção: ");
                switch ($resposta2) {
                    case '1':
                        $modoDeJogo = "termo";
                        echo "\e[H\e[J";
                        $jogo = TDQ($modoDeJogo, $bibliotecaPalavras);
                        array_push($historico, $jogo);

                        break;
                    case '2':
                        $modoDeJogo = "dueto";
                        echo "\e[H\e[J";
                        $jogo = TDQ($modoDeJogo, $bibliotecaPalavras);
                        array_push($historico, $jogo);
                        break;
                    case '3':
                        $modoDeJogo = "quarteto";
                        echo "\e[H\e[J";
                        $jogo = TDQ($modoDeJogo, $bibliotecaPalavras);
                        array_push($historico, $jogo);
                        break;
                    case '0':
                        echo "Saindo...";
                        echo "\e[H\e[J";
                        break;
                    default:
                        echo "\e[H\e[J";
                        echo "Opção inválida \n";
                        break;
                }
            } while ($resposta2 != 0);
            break;

        case '2':
            echo "\e[H\e[J";
            if ($historico == null) {
                echo "\nVocê ainda não tem nenhum histórico de partidas \n";
            } else {
                $i = 1;
                foreach ($historico as $partida) {
                    echo "\nPartida $i: \n";
                    echo $partida;
                    $i++;
                }
            }
            break;
        case '3':
            // permite usar o metodo getRegras sem precisar criar um new Partida
            echo "\e[H\e[J";
            $regras = Partida::getRegras();
            echo $regras;
            break;
        case '0':
            echo "\e[H\e[J";
            echo "Saindo...";
            break;
        default:
            echo "\e[H\e[J";
            echo "Opção inválida \n";
            break;
    }
} while ($resposta != 0);
// -----------------