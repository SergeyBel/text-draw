<?php

declare(strict_types=1);

namespace TextDraw\Figure\Chart\Function;

use TextDraw\Common\Char;

class FunctionGraphStyle
{
    private Char $pointChar;
    private Char $zeroChar;

    public function __construct()
    {
        $this->pointChar = new Char('*');
        $this->zeroChar = new Char('0');
    }


    public function getPointChar(): string
    {
        return $this->pointChar->getChar();
    }

    public function setPointChar(string $pointChar): static
    {
        $this->pointChar = new Char($pointChar);
        return $this;
    }

    public function getZeroChar(): string
    {
        return $this->zeroChar->getChar();
    }

    public function setZeroChar(string $zeroSymbol): static
    {
        $this->zeroChar = new Char($zeroSymbol);
        return $this;
    }
}
