<?php

namespace ConsoleDraw\Figure\Geometry\Rechtangle;

use ConsoleDraw\Figure\BaseFigure;
use ConsoleDraw\Figure\Geometry\Line\Line;

class Rectangle extends BaseFigure
{
    public function __construct(
        private int $x,
        private int $y,
        private int $width,
        private int $height,
        private string $char
    ) {
    }

    public function draw(): array
    {
        $x = $this->x;
        $y = $this->y;
        $width = $this->width - 1;
        $height = $this->height - 1;
        $char = $this->char;

        $this
            ->addFigure(new Line($x, $y, $x + $width, $y, $char))
            ->addFigure(new Line($x, $y, $x, $y + $height, $char))
            ->addFigure(new Line($x + $width, $y, $x + $width, $y + $height, $char))
            ->addFigure(new Line($x, $y + $height, $x + $width, $y + $height, $char));

        return parent::draw();
    }


}
