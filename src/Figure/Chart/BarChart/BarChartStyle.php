<?php

declare(strict_types=1);

namespace TextDraw\Figure\Chart\BarChart;

use TextDraw\Common\Char;

class BarChartStyle
{
    private int $barWidth = 2;
    private int $unitHeight = 1;
    private Char $horizontalChar;
    private Char $verticalChar;
    private Char $crossingChar;
    private int $gap = 1;

    public function __construct()
    {
        $this->horizontalChar = new Char('*');
        $this->verticalChar = new Char('*');
        $this->crossingChar = new Char('*');
    }


    public function getBarWidth(): int
    {
        return $this->barWidth;
    }

    public function setBarWidth(int $barWidth): static
    {
        $this->barWidth = $barWidth;
        return $this;
    }

    public function getUnitHeight(): int
    {
        return $this->unitHeight;
    }

    public function setUnitHeight(int $unitHeight): static
    {
        $this->unitHeight = $unitHeight;
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

    public function getGap(): int
    {
        return $this->gap;
    }

    public function setGap(int $gap): self
    {
        $this->gap = $gap;
        return $this;
    }




}
