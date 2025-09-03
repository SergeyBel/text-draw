<?php

declare(strict_types=1);

namespace TextDraw\Figure\Pixel;

use TextDraw\Figure\Base\BaseFigure;
use TextDraw\Plane\Point;
use TextDraw\Screen\PixelMatrix;

class Pixel extends BaseFigure
{
    public function __construct(
        private Point $point,
        private string $char,
    ) {
        parent::__construct();
    }

    public function draw(): PixelMatrix
    {
        return new PixelMatrix([$this]);
    }

    public function getPoint(): Point
    {
        return $this->point;
    }

    public function setPoint(Point $point): static
    {
        $this->point = $point;
        return $this;
    }

    public function getChar(): string
    {
        return $this->char;
    }

    public function setChar(string $char): static
    {
        $this->char = $char;
        return $this;
    }


}
