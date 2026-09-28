<?php
require_once("Partida.php");
require_once("IVerificarPalavra.php");

class Termo implements IVerificarPalavra
{
    protected array $palavras;
    protected array $letras;
    protected Partida $partida;

    // public function verificarPalavra(array $letrasChute, array $cores, array $letras)
    // {
    //     for ($i = 0; $i < 5; $i++) {
    //         if ($letrasChute[$i] == $letras[$i]) {
    //             echo $cores["verde"] . "$letrasChute[$i] na posição certa!\n" . $cores["reset"]; // volta pra cor padrao
    //         } else if (in_array($letrasChute[$i], $letras)) {
    //             echo $cores["amarelo"] . "Tem $letrasChute[$i] na palavra!\n" . $cores["reset"];
    //         } else {
    //             echo "$letrasChute[$i] não tem na palavra \n";
    //         }
    //     }
    // } Desse jeito ele imprimia tudo no metódo porém eu lembrei que não era certo imprimir tudo no metódo

    public function verificarPalavra(array $letrasChute,  array $letras)
    {
        $verificação = [];
        for ($i = 0; $i < 5; $i++) {
            if ($letrasChute[$i] == $letras[$i]) {
                $verificação[$i] = "verde";
            } else if (in_array($letrasChute[$i], $letras)) {
                $verificação[$i] = "amarelo";
            } else {
                $verificação[$i] = "reset";
            }
        }
        return $verificação;
    }
    public function __toString()
    {
        $dados = "Modo de Jogo: " .$this->partida->getModoDeJogo() . "\n";
        if ($this->partida->getGanhouPerdeu()){
            $dados .= "Partida ganhada \n";
        }else {
            $dados .= "Partida perdida \n";
        }
        $dados .=  "Tentativas: " . $this->partida->getTentativas() . "\n";
        return $dados;
    }

    public function __construct(array $palavras)
    {
        $this->palavras = $palavras;
        $this->letras = $this->obterLetras();
    }
    public function obterLetras(): array
    {
        return str_split($this->palavras[0]);
    }

    public function getPalavra(): array
    {
        return $this->palavras;
    }

    public function setPalavra(array $palavras): void
    {
        $this->palavras = $palavras;
    }

    public function getLetras(): array
    {
        return $this->letras;
    }

    public function setLetras(array $letras): void
    {
        $this->letras = $letras;
    }
    public function getPartida(): Partida
    {
        return $this->partida;
    }

    public function setPartida(Partida $partida): void
    {
        $this->partida = $partida;
    }
    // public function getPalavras(): array
    // {
    //     return $this->palavras;
    // }

    // public function setPalavras(array $palavras): void
    // {
    //     $this->palavras = $palavras;
    // }
}
