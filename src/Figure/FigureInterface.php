<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure;

interface FigureInterface
{
    /**
     * @return array<Pixel>
     */
    public function draw(): array;

}
