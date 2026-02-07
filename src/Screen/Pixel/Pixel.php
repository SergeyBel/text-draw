<?php

declare(strict_types=1);

namespace TextDraw\Screen\Pixel;

use TextDraw\Common\Char;
use TextDraw\Plane\Point;

class Pixel
{
    private Char $char;

    public function __construct(
        private Point $point,
        string $char,
    ) {
        $this->char = new Char($char);
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
        return $this->char->getChar();
    }

    public function setChar(string $char): static
    {
        $that = clone $this;

        $that->char = new Char($char);
        return $that;
    }
}
