<?php

namespace ConsoleDraw\Figure\Geometry\Rechtangle;

use ConsoleDraw\Figure\BaseFigure;
use ConsoleDraw\Figure\Geometry\Line\Line;
use ConsoleDraw\Figure\Geometry\Line\LineStyle;

class Rectangle extends BaseFigure
{
    private RectangleStyle $style;

    public function __construct(
        private int $x,
        private int $y,
        private int $width,
        private int $height,
    ) {
    }

    public function draw(): array
    {
        $x = $this->x;
        $y = $this->y;
        $width = $this->width - 1;
        $height = $this->height - 1;
        $lineStyle = (new LineStyle())->setSymbol($this->style->getSymbol());

        $this
            ->addFigure((new Line($x, $y, $x + $width, $y))->setStyle($lineStyle))
            ->addFigure((new Line($x, $y, $x, $y + $height))->setStyle($lineStyle))
            ->addFigure((new Line($x + $width, $y, $x + $width, $y + $height))->setStyle($lineStyle))
            ->addFigure((new Line($x, $y + $height, $x + $width, $y + $height))->setStyle($lineStyle));

        return parent::draw();
    }

    public function getStyle(): RectangleStyle
    {
        return $this->style;
    }

    public function setStyle(RectangleStyle $style): Rectangle
    {
        $this->style = $style;
        return $this;
    }




}
