<?php

declare(strict_types=1);

namespace TextDraw\Figure\Pixel;

use TextDraw\Figure\Base\BaseFigure;
use TextDraw\Plane\Point;
use TextDraw\Screen\Screen;
use TextDraw\Common\Char;

class Pixel extends BaseFigure
{
    private Char $char;

    public function __construct(
        private Point $point,
        string $char,
    ) {
        $this->char = new Char($char);
        parent::__construct();
    }

    public function draw(): Screen
    {
        return new Screen([$this]);
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
