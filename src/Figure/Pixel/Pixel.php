<?php

declare(strict_types=1);

namespace TextDraw\Figure\Pixel;

use TextDraw\Figure\Base\BaseFigure;
use TextDraw\Plane\Point;
use TextDraw\Screen\Screen;

class Pixel extends BaseFigure
{
    public function __construct(
        private Point $point,
        private string $char,
    ) {
        parent::__construct();
    }

    public function getScreen(): Screen
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
        return $this->char;
    }

    public function setChar(string $char): static
    {
        $that = clone $this;

        $that->char = $char;
        return $that;
    }


}
