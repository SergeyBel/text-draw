<?php

namespace ConsoleDraw\Figure\Geometry\Triangle;

class TriangleStyle
{
    private string $symbol = '*';

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function setSymbol(string $symbol): TriangleStyle
    {
        $this->symbol = $symbol;
        return $this;
    }


}