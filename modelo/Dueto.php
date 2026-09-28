<?php

require_once("Termo.php");

class Dueto extends Termo
{
    public function obterLetras(): array
    {
        return [
            str_split($this->palavras[0]), 
            str_split($this->palavras[1])
        ];
    }
}
