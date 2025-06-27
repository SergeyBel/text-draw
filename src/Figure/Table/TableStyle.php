<?php

declare(strict_types=1);

namespace TextDraw\Figure\Table;

use TextDraw\Common\TextAlign;

class TableStyle
{
    private string $verticalChar = '|';
    private string $horizontalChar = '-';
    private string $crossingChar = '+';
    private string $paddingChar = ' ';
    private TextAlign $align = TextAlign::Left;
    private TextAlign $headerAlign = TextAlign::Left;

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

    public function setAlign(TextAlign $align): static
    {
        $this->align = $align;
        return $this;
    }

    public function setHeaderAlign(TextAlign $headerAlign): static
    {
        $this->headerAlign = $headerAlign;
        return $this;
    }

    public function getHeaderAlign(): TextAlign
    {
        return $this->headerAlign;
    }

    public function getAlign(): TextAlign
    {
        return $this->align;
    }
}
