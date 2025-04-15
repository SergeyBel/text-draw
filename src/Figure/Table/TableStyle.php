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

    public function getColumnMaxWidth(): ?int
    {
        return $this->columnMaxWidth;
    }

    public function setColumnMaxWidth(?int $columnMaxWidth): static
    {
        $this->columnMaxWidth = $columnMaxWidth;
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

    public function alignCenter(): static
    {
        $this->align = TextAlign::Center;
        return $this;
    }

    public function alignRight(): static
    {
        $this->align = TextAlign::Right;
        return $this;
    }

    public function alignHeaderCenter(): static
    {
        $this->headerAlign = TextAlign::Center;
        return $this;
    }

    public function alignHeaderRight(): static
    {
        $this->headerAlign = TextAlign::Right;
        return $this;
    }

    public function getAlign(): TextAlign
    {
        return $this->align;
    }

    public function getHeaderAlign(): TextAlign
    {
        return $this->headerAlign;
    }

}
