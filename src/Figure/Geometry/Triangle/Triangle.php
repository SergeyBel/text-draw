<?php

namespace ConsoleDraw\Figure\Geometry\Triangle;

use ConsoleDraw\Figure\BaseFigure;
use ConsoleDraw\Figure\Geometry\Line\Line;

class Triangle extends BaseFigure
{
    public function __construct(
        private int $x1,
        private int $y1,
        private int $x2,
        private int $y2,
        private int $x3,
        private int $y3,
        private string $char
    ) {
    }

    public function draw(): array
    {
        $this
            ->addFigure(new Line($this->x1, $this->y1, $this->x2, $this->y2, $this->char))
            ->addFigure(new Line($this->x2, $this->y2, $this->x3, $this->y3, $this->char))
            ->addFigure(new Line($this->x3, $this->y3, $this->x1, $this->y1, $this->char));

        return parent::draw();
    }
}
