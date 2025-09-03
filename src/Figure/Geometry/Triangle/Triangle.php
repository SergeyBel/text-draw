<?php

declare(strict_types=1);

namespace TextDraw\Figure\Geometry\Triangle;

use TextDraw\Figure\Base\BaseFigure;
use TextDraw\Figure\Geometry\Line\Line;
use TextDraw\Plane\Point;
use TextDraw\Screen\Screen;

class Triangle extends BaseFigure
{
    public function __construct(
        private Point $vertex1,
        private Point $vertex2,
        private Point $vertex3,
    ) {
        parent::__construct();
    }

    public function draw(): Screen
    {
        $this
            ->addFigure(new Line($this->vertex1, $this->vertex2))
            ->addFigure(new Line($this->vertex2, $this->vertex3))
            ->addFigure(new Line($this->vertex3, $this->vertex1));

        return parent::draw();
    }
}
