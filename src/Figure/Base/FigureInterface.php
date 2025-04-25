<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Base;

use ConsoleDraw\Figure\Pixel\PixelMatrix;

interface FigureInterface
{
    public function draw(): PixelMatrix;


}
