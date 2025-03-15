<?php

namespace ConsoleDraw\Figure\Geometry\Rechtangle;

use ConsoleDraw\Figure\BaseFigure;
use ConsoleDraw\Figure\Geometry\Line\Line;
use ConsoleDraw\Figure\Geometry\Line\LineStyle;
use ConsoleDraw\Plane\Point;
use ConsoleDraw\Plane\Size;

class Rectangle extends BaseFigure
{
    private RectangleStyle $style;

    public function __construct(
        private Point $leftUpperCorner,
        private Size $size,

    ) {
        $this->style = new RectangleStyle();
    }

    public function draw(): array
    {

        $lineStyle = (new LineStyle())->setSymbol($this->style->getSymbol());

        $rightUpperCorner = $this->leftUpperCorner->addWidth($this->size->getWidth());
        $leftBottomCorner = $this->leftUpperCorner->addHeight($this->size->getHeight());
        $rightBottomCorner = $rightUpperCorner->addHeight($this->size->getHeight());


        $this
            ->addFigure((new Line($this->leftUpperCorner, $rightUpperCorner))->setStyle($lineStyle))
            ->addFigure((new Line($rightUpperCorner, $rightBottomCorner))->setStyle($lineStyle))
            ->addFigure((new Line($rightBottomCorner, $leftBottomCorner))->setStyle($lineStyle))
            ->addFigure((new Line($leftBottomCorner, $this->leftUpperCorner))->setStyle($lineStyle));

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
