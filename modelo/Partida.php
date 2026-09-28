<?php

class Partida {
    private bool $ganhou_perdeu;
    private int $tentativas;
    private string $ModoDeJogo;


    function __construct(bool $ganhou_perdeu, int $tentativas, string $ModeoDeJogo) {
        $this->ganhou_perdeu = $ganhou_perdeu;
        $this->tentativas = $tentativas;
        $this->ModoDeJogo = $ModeoDeJogo;
        
    }
    public function getGanhouPerdeu(): bool
{
    return $this->ganhou_perdeu;
}

// static permite permite usar metodos ou propiedades sem ter que instanciar uma classe
public static function  getRegras(): string
    {
        $dados = "";

        $dados .= "Descubra a palavra certa.\nDepois de cada tentativa, as letras mostram o quão perto você está da solução.\n\n";
        $dados .= "🟩 VERDE: A letra faz parte da palavra e está na posição correta.\n";
        $dados .= "🟨 AMARELO: A letra faz parte da palavra, mas está em outra posição.\n";
        $dados .= "⬛ CINZA: A letra não faz parte da palavra.\n";

        return $dados;
    }

public function setGanhouPerdeu(bool $ganhou_perdeu): void
{
    $this->ganhou_perdeu = $ganhou_perdeu;
}

public function getTentativas(): int
{
    return $this->tentativas;
}

public function setTentativas(int $tentativas): void
{
    $this->tentativas = $tentativas;
}

public function getModoDeJogo(): string
{
    return $this->ModoDeJogo;
}

public function setModoDeJogo(string $ModeoDeJogo): void
{
    $this->ModoDeJogo = $ModeoDeJogo;
}

}