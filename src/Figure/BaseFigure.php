<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure;

use ConsoleDraw\Figure\Pixel\PixelMatrix;

class BaseFigure implements FigureInterface
{
    protected PixelMatrix $pixels;


    public function __construct()
    {
        $this->pixels = new PixelMatrix();
    }


    public function draw(): PixelMatrix
    {
        return $this->pixels;
    }

    protected function addFigure(FigureInterface $figure): static
    {
        $this->pixels->merge($figure->draw());
        return $this;
    }


}
