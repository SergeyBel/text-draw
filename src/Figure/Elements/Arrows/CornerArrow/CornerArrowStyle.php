<?php

declare(strict_types=1);

namespace TextDraw\Figure\Elements\Arrows\CornerArrow;

use TextDraw\Common\Char;

class CornerArrowStyle
{
    private Char $horizontalChar;
    private Char $verticalChar;

    public function __construct()
    {
        $this->horizontalChar = new Char('-');
        $this->verticalChar = new Char('|');
    }

    public function getHorizontalChar(): string
    {
        return $this->horizontalChar->getChar();
    }

    public function setHorizontalChar(string $horizontalChar): self
    {
        $this->horizontalChar = new Char($horizontalChar);
        return $this;
    }

    public function getVerticalChar(): string
    {
        return $this->verticalChar->getChar();
    }

    public function setVerticalChar(string $verticalChar): self
    {
        $this->verticalChar = new Char($verticalChar);
        return $this;
    }
}
