<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure;

use ConsoleDraw\Figure\Pixel\PixelMatrix;

interface FigureInterface
{
    public function draw(): PixelMatrix;

}
