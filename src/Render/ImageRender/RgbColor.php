<?php

declare(strict_types=1);

namespace ConsoleDraw\Render\ImageRender;

use InvalidArgumentException;

class RgbColor
{
    private int $red;
    private int $green;
    private int $blue;


    public function __construct(int $red, int $green, int $blue)
    {
        $this->setRed($red);
        $this->setGreen($green);
        $this->setBlue($blue);
    }


    public function setRed(int $red): void
    {
        $this->red = $this->validateColorValue($red);
    }


    public function setGreen(int $green): void
    {
        $this->green = $this->validateColorValue($green);
    }

    public function setBlue(int $blue): void
    {
        $this->blue = $this->validateColorValue($blue);
    }

    public function getRed(): int
    {
        return $this->red;
    }


    public function getGreen(): int
    {
        return $this->green;
    }

    public function getBlue(): int
    {
        return $this->blue;
    }


    private function validateColorValue(int $value): int
    {
        if ($value < 0 || $value > 255) {
            throw new InvalidArgumentException('Значение цвета должно быть в интервале от 0 до 255.');
        }
        return $value;
    }
}
