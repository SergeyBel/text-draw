<?php

namespace ConsoleDraw;

interface FigureInterface
{
    /**
     * @return array<Point>
     */
    public function getPoints(): array;

}
