<?php

declare(strict_types=1);

namespace TextDraw\Figure\Geometry\Rectangle;

use TextDraw\Common\Char;

class RectangleStyle
{
    private Char $horizontalChar;
    private Char $verticalChar;
    private Char $crossingChar;

    public function __construct()
    {
        $this->horizontalChar = new Char('-');
        $this->verticalChar = new Char('|');
        $this->crossingChar = new Char('+');
    }

    public function getHorizontalChar(): string
    {
        return $this->horizontalChar->getChar();
    }

    public function setHorizontalChar(string $horizontalChar): static
    {
        $this->horizontalChar = new Char($horizontalChar);
        return $this;
    }

    public function getVerticalChar(): string
    {
        return $this->verticalChar->getChar();
    }

    public function setVerticalChar(string $verticalChar): static
    {
        $this->verticalChar = new Char($verticalChar);
        return $this;
    }

    public function getCrossingChar(): string
    {
        return $this->crossingChar->getChar();
    }

    public function setCrossingChar(string $crossingChar): static
    {
        $this->crossingChar = new Char($crossingChar);
        return $this;
    }

    public function setChar(string $char): self
    {
        return $this
            ->setCrossingChar($char)
            ->setHorizontalChar($char)
            ->setVerticalChar($char);
    }
}
