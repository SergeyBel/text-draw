<?php

declare(strict_types=1);

namespace TextDraw\Figure\Chart\Function;

class FunctionGraphStyle
{
    private string $pointSymbol = '*';
    private string $zeroSymbol = '0';


    public function getPointSymbol(): string
    {
        return $this->pointSymbol;
    }

    public function setPointSymbol(string $pointSymbol): static
    {
        $this->pointSymbol = $pointSymbol;
        return $this;
    }

    public function getZeroSymbol(): string
    {
        return $this->zeroSymbol;
    }

    public function setZeroSymbol(string $zeroSymbol): static
    {
        $this->zeroSymbol = $zeroSymbol;
        return $this;
    }
}
