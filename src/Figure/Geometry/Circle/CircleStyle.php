<?php

namespace ConsoleDraw\Figure\Geometry\Circle;

class CircleStyle
{
    private string $symbol = '*';

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function setSymbol(string $symbol): CircleStyle
    {
        $this->symbol = $symbol;
        return $this;
    }



}