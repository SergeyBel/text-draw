<?php

namespace ConsoleDraw;

class Rectangle implements FigureInterface
{

    public function __construct(
        private int $x,
        private int $y,
        private int $width,
        private int $height,
        private string $char
    )
    {
    }

    public function getPoints(): array
    {
        $points = [];
        $x = $this->x;
        $y = $this->y;
        $width = $this->width - 1;
        $height = $this->height - 1;
        $char = $this->char;

        $points = array_merge($points, (new Line($x, $y, $x + $width, $y, $char))->getPoints());
        $points = array_merge($points, (new Line($x, $y, $x, $y + $height, $char))->getPoints());
        $points = array_merge($points, (new Line($x + $width, $y, $x + $width, $y + $height, $char))->getPoints());
        $points = array_merge($points, (new Line($x, $y + $height, $x + $width, $y + $height, $char))->getPoints());


        return $points;
    }


}