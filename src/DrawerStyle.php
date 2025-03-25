<?php

declare(strict_types=1);

namespace ConsoleDraw;

class DrawerStyle
{
    private string $emptySymbol = ' ';

    public function getEmptySymbol(): string
    {
        return $this->emptySymbol;
    }

    public function setEmptySymbol(string $emptySymbol): DrawerStyle
    {
        $this->emptySymbol = $emptySymbol;
        return $this;
    }
}
