<?php

declare(strict_types=1);

namespace TextDraw\Figure\Table;

use TextDraw\Common\HorizontalAlign;
use TextDraw\Common\Char;

class TableStyle
{
    private Char $verticalChar;
    private Char $horizontalChar;
    private Char $crossingChar;
    private Char $paddingChar;
    private HorizontalAlign $align = HorizontalAlign::Left;
    private HorizontalAlign $headerAlign = HorizontalAlign::Left;

    public function __construct()
    {
        $this->verticalChar = new Char('|');
        $this->horizontalChar = new Char('-');
        $this->crossingChar = new Char('+');
        $this->paddingChar = new Char(' ');

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

    public function getHorizontalChar(): string
    {
        return $this->horizontalChar->getChar();
    }

    public function setHorizontalChar(string $horizontalChar): static
    {
        $this->horizontalChar = new Char($horizontalChar);
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


    public function getPaddingChar(): string
    {
        return $this->paddingChar->getChar();
    }

    public function setPaddingChar(string $paddingChar): static
    {
        $this->paddingChar = new Char($paddingChar);
        return $this;
    }

    public function setAlign(HorizontalAlign $align): static
    {
        $this->align = $align;
        return $this;
    }

    public function setHeaderAlign(HorizontalAlign $headerAlign): static
    {
        $this->headerAlign = $headerAlign;
        return $this;
    }

    public function getHeaderAlign(): HorizontalAlign
    {
        return $this->headerAlign;
    }

    public function getAlign(): HorizontalAlign
    {
        return $this->align;
    }
}
