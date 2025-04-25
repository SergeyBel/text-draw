<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Base;

use ConsoleDraw\Figure\Pixel\PixelMatrix;

class BaseFigure implements FigureInterface
{
    protected PixelMatrix $pixelMatrix;


    public function __construct()
    {
        $this->pixelMatrix = new PixelMatrix();
    }


    public function draw(): PixelMatrix
    {
        return $this->pixelMatrix;
    }

    protected function addFigure(FigureInterface $figure): static
    {
        $this->pixelMatrix->merge($figure->draw());
        return $this;
    }


}
