<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\FunctionGraph;

class FunctionGraphStyle
{
    private string $pointSymbol = '*';
    private string $zeroSymbol = '0';


    public function getPointSymbol(): string
    {
        return $this->pointSymbol;
    }

    public function setPointSymbol(string $pointSymbol): FunctionGraphStyle
    {
        $this->pointSymbol = $pointSymbol;
        return $this;
    }

    public function getZeroSymbol(): string
    {
        return $this->zeroSymbol;
    }

    public function setZeroSymbol(string $zeroSymbol): FunctionGraphStyle
    {
        $this->zeroSymbol = $zeroSymbol;
        return $this;
    }
}
