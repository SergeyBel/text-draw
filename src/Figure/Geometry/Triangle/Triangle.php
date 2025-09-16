<?php

declare(strict_types=1);

namespace TextDraw\Figure\Geometry\Triangle;

use TextDraw\Figure\Base\BaseFigure;
use TextDraw\Figure\Geometry\Line\Line;
use TextDraw\Plane\Point;
use TextDraw\Screen\Screen;
use TextDraw\Figure\Geometry\Line\LineStyle;

class Triangle extends BaseFigure
{
    private TriangleStyle $style;

    public function __construct(
        private Point $vertex1,
        private Point $vertex2,
        private Point $vertex3,
    ) {
        $this->style = new TriangleStyle();
        parent::__construct();
    }

    public function getScreen(): Screen
    {
        $lineStyle = new LineStyle()->setChar($this->style->getChar());
        $this
            ->addFigure(new Line($this->vertex1, $this->vertex2)->setStyle($lineStyle))
            ->addFigure(new Line($this->vertex2, $this->vertex3)->setStyle($lineStyle))
            ->addFigure(new Line($this->vertex3, $this->vertex1)->setStyle($lineStyle));

        return parent::getScreen();
    }

    public function setStyle(TriangleStyle $style): self
    {
        $this->style = $style;
        return $this;
    }
}
