<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Pixel;

use ConsoleDraw\Figure\FigureInterface;
use ConsoleDraw\Plane\Point;

class Pixel implements FigureInterface
{
    public function __construct(
        private Point $point,
        private string $symbol,
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

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function setSymbol(string $symbol): self
    {
        $this->symbol = $symbol;
        return $this;
    }


}
