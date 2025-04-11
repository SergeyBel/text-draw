<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Geometry\Rechtangle;

use ConsoleDraw\Figure\BaseFigure;
use ConsoleDraw\Figure\Geometry\Line\Line;
use ConsoleDraw\Figure\Geometry\Line\LineStyle;
use ConsoleDraw\Figure\Pixel\PixelMatrix;
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

        parent::__construct();
    }

    public function draw(): PixelMatrix
    {

        $lineStyle = (new LineStyle())->setSymbol($this->style->getSymbol());


        $rightUpperCorner = $this->leftUpperCorner->addWidth($this->size->getWidth());
        $leftBottomCorner = $this->leftUpperCorner->addHeight($this->size->getHeight());
        $rightBottomCorner = $rightUpperCorner->addHeight($this->size->getHeight());


        $top = (new Line($this->leftUpperCorner, $rightUpperCorner))->setStyle($lineStyle);
        $right = (new Line($rightUpperCorner, $rightBottomCorner))->setStyle($lineStyle);
        $bottom = (new Line($rightBottomCorner, $leftBottomCorner))->setStyle($lineStyle);
        $left = (new Line($leftBottomCorner, $this->leftUpperCorner))->setStyle($lineStyle);

        $this
            ->addFigure($top)
            ->addFigure($bottom)
            ->addFigure($left)
            ->addFigure($right);

        foreach ($this->style->getSideStyles() as $sideValue => $style) {
            $side = RectangleSide::from($sideValue);

            match ($side) {
                RectangleSide::Top => $this->addFigure($top->setStyle($style)),
                RectangleSide::Bottom => $this->addFigure($bottom->setStyle($style)),
                RectangleSide::Left => $this->addFigure($left->setStyle($style)),
                RectangleSide::Right => $this->addFigure($right->setStyle($style)),
            };
        }


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
