<?php

declare(strict_types=1);

namespace TextDraw\Figure\Table;

use TextDraw\Common\HorizontalAlign;

class TableStyle
{
    private string $verticalChar = '|';
    private string $horizontalChar = '-';
    private string $crossingChar = '+';
    private string $paddingChar = ' ';
    private HorizontalAlign $align = HorizontalAlign::Left;
    private HorizontalAlign $headerAlign = HorizontalAlign::Left;

    public function getVerticalChar(): string
    {
        return $this->verticalChar;
    }

    public function setVerticalChar(string $verticalChar): static
    {
        $this->verticalChar = $verticalChar;
        return $this;
    }

    public function getHorizontalChar(): string
    {
        return $this->horizontalChar;
    }

    public function setHorizontalChar(string $horizontalChar): static
    {
        $this->horizontalChar = $horizontalChar;
        return $this;
    }

    public function getCrossingChar(): string
    {
        return $this->crossingChar;
    }

    public function setCrossingChar(string $crossingChar): static
    {
        $this->crossingChar = $crossingChar;
        return $this;
    }


    public function getPaddingChar(): string
    {
        return $this->paddingChar;
    }

    public function setPaddingChar(string $paddingChar): static
    {
        $this->paddingChar = $paddingChar;
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
