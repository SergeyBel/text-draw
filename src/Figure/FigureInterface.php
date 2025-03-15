<?php

namespace ConsoleDraw\Figure;

interface FigureInterface
{
    /**
     * @return array<Pixel>
     */
    public function draw(): array;

}
