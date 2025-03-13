<?php

namespace ConsoleDraw\Figure\Geometry\Rechtangle;

class RectangleStyle
{
    private string $symbol = '*';

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;
        return $this;
    }




}
