<?php

declare(strict_types=1);

namespace TextDraw\Figure\Base;

use TextDraw\Screen\PixelMatrix;

interface FigureInterface
{
    public function draw(): PixelMatrix;


}
