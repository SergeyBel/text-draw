<?php

namespace ConsoleDraw\Figure;

use ConsoleDraw\Pixel;

interface FigureInterface
{
    /**
     * @return array<Pixel>
     */
    public function draw(): array;

}
