<?php

require_once("Dueto.php");

class Quarteto extends Dueto {
    public function obterLetras(): array
    {
        return [
            str_split($this->palavras[0]), 
            str_split($this->palavras[1]),
            str_split($this->palavras[2]),
            str_split($this->palavras[3])
        ];
    }
}