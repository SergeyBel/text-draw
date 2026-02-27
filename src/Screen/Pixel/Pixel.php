<?php

declare(strict_types=1);

namespace TextDraw\Screen\Pixel;

use TextDraw\Plane\Point;

class Pixel
{
    public function __construct(
        private Point $point,
        private string $char,
    ) {
    }

    public function getPoint(): Point
    {
        return $this->point;
    }

    public function setPoint(Point $point): static
    {
        $that = clone $this;

        $that->point = $point;
        return $that;
    }

    public function getChar(): string
    {
        return $this->char;
    }

    public function setChar(string $char): static
    {
        $that = clone $this;

        $that->char = $char;
        return $that;
    }
}
