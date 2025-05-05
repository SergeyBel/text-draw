<?php

declare(strict_types=1);

namespace TextDraw\Figure\Geometry\Rechtangle;

class RectangleStyle
{
    private string $horizontalChar = '*';
    private string $verticalChar = '*';
    private string $crossingChar = '*';

    public function getHorizontalChar(): string
    {
        return $this->horizontalChar;
    }

    public function setHorizontalChar(string $horizontalChar): static
    {
        $this->horizontalChar = $horizontalChar;
        return $this;
    }

    public function getVerticalChar(): string
    {
        return $this->verticalChar;
    }

    public function setVerticalChar(string $verticalChar): static
    {
        $this->verticalChar = $verticalChar;
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



}
