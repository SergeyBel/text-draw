<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Table;

class TableStyle
{
    private string $verticalSymbol = '|';
    private string $horizontalSymbol = '-';
    private string $crossingSymbol = '+';
    private string $paddingSymbol = ' ';
    private ?int $columnMaxWidth = null;

    public function getVerticalSymbol(): string
    {
        return $this->verticalSymbol;
    }

    public function setVerticalSymbol(string $verticalSymbol): TableStyle
    {
        $this->verticalSymbol = $verticalSymbol;
        return $this;
    }

    public function getHorizontalSymbol(): string
    {
        return $this->horizontalSymbol;
    }

    public function setHorizontalSymbol(string $horizontalSymbol): TableStyle
    {
        $this->horizontalSymbol = $horizontalSymbol;
        return $this;
    }

    public function getCrossingSymbol(): string
    {
        return $this->crossingSymbol;
    }

    public function setCrossingSymbol(string $crossingSymbol): TableStyle
    {
        $this->crossingSymbol = $crossingSymbol;
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

    public function getPaddingSymbol(): string
    {
        return $this->paddingSymbol;
    }

    public function setPaddingSymbol(string $paddingSymbol): TableStyle
    {
        $this->paddingSymbol = $paddingSymbol;
        return $this;
    }




}
