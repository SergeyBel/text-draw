<?php

namespace ConsoleDraw;

class ConsoleStyle
{
    private string $emptySymbol = ' ';

    public function getEmptySymbol(): string
    {
        return $this->emptySymbol;
    }

    public function setEmptySymbol(string $emptySymbol): ConsoleStyle
    {
        $this->emptySymbol = $emptySymbol;
        return $this;
    }
}
