<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Geometry\Triangle;

use ConsoleDraw\Figure\BaseFigure;
use ConsoleDraw\Figure\Geometry\Line\Line;
use ConsoleDraw\Figure\Pixel\PixelMatrix;
use ConsoleDraw\Plane\Point;

class Triangle extends BaseFigure
{
    public function __construct(
        private Point $vertex1,
        private Point $vertex2,
        private Point $vertex3,
    ) {
        parent::__construct();
    }

    public function draw(): PixelMatrix
    {
        $this
            ->addFigure(new Line($this->vertex1, $this->vertex2))
            ->addFigure(new Line($this->vertex2, $this->vertex3))
            ->addFigure(new Line($this->vertex3, $this->vertex1));

        return parent::draw();
    }
}
