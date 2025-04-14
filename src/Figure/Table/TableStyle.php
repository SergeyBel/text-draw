<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Table;

use ConsoleDraw\Figure\Text\TextAlign;

class TableStyle
{
    private string $verticalChar = '|';
    private string $horizontalChar = '-';
    private string $crossingChar = '+';
    private string $paddingChar = ' ';
    private ?int $columnMaxWidth = null;
    private TextAlign $align = TextAlign::LEFT;

    public function getVerticalChar(): string
    {
        return $this->verticalChar;
    }

    public function setVerticalChar(string $verticalChar): TableStyle
    {
        $this->verticalChar = $verticalChar;
        return $this;
    }

    public function getHorizontalChar(): string
    {
        return $this->horizontalChar;
    }

    public function setHorizontalChar(string $horizontalChar): TableStyle
    {
        $this->horizontalChar = $horizontalChar;
        return $this;
    }

    public function getCrossingChar(): string
    {
        return $this->crossingChar;
    }

    public function setCrossingChar(string $crossingChar): TableStyle
    {
        $this->crossingChar = $crossingChar;
        return $this;
    }

    public function getColumnMaxWidth(): ?int
    {
        return $this->columnMaxWidth;
    }

    public function setColumnMaxWidth(?int $columnMaxWidth): TableStyle
    {
        $this->columnMaxWidth = $columnMaxWidth;
        return $this;
    }

    public function getPaddingChar(): string
    {
        return $this->paddingChar;
    }

    public function setPaddingChar(string $paddingChar): TableStyle
    {
        $this->paddingChar = $paddingChar;
        return $this;
    }

    public function alignRight(): self
    {
        $this->align = TextAlign::RIGHT;
        return $this;
    }

    public function alignCenter(): self
    {
        $this->align = TextAlign::CENTER;
        return $this;
    }

    public function getAlign(): TextAlign
    {
        return $this->align;
    }
}
