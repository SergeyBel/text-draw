<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Pixel;

use ConsoleDraw\Figure\FigureInterface;
use ConsoleDraw\Plane\Point;

class Pixel implements FigureInterface
{
    public function __construct(
        private Point $point,
        private string $char,
    ) {
    }

    public function draw(): PixelMatrix
    {
        return new PixelMatrix([$this]);
    }

    public function getPoint(): Point
    {
        return $this->point;
    }

    public function setPoint(Point $point): self
    {
        $this->point = $point;
        return $this;
    }

    public function getChar(): string
    {
        return $this->char;
    }

    public function setChar(string $char): self
    {
        $this->char = $char;
        return $this;
    }


}
