<?php

declare(strict_types=1);

namespace TextDraw\Figure\Diagram\Elements\Arrow;

use TextDraw\Common\Char;
use TextDraw\Common\HorizontalAlign;

class ArrowStyle
{
    private Char $horizontalChar;
    private Char $verticalChar;
    private HorizontalAlign $align = HorizontalAlign::Center;

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

    public function getAlign(): HorizontalAlign
    {
        return $this->align;
    }

    public function setAlign(HorizontalAlign $align): self
    {
        $this->align = $align;
        return $this;
    }




}
