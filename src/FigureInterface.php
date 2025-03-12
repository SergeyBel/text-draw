<?php

namespace ConsoleDraw;

interface FigureInterface
{
    /**
     * @return array<Pixel>
     */
    public function getPixels(): array;

}
