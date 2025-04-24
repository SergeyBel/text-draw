<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Geometry\Rechtangle;

use ConsoleDraw\Common\Size;
use ConsoleDraw\Figure\Base\BaseFigure;
use ConsoleDraw\Figure\Geometry\Line\Line;
use ConsoleDraw\Figure\Geometry\Line\LineStyle;
use ConsoleDraw\Figure\Pixel\PixelMatrix;
use ConsoleDraw\Plane\Point;

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

        $horizontalLineStyle = (new LineStyle())
                ->setSymbol($this->style->getHorizontalChar())
                ->setStartChar($this->style->getCrossingChar())
                ->setFinishChar($this->style->getCrossingChar())
        ;

        $verticalLineStyle = (new LineStyle())
            ->setSymbol($this->style->getVerticalChar())
            ->setStartChar($this->style->getCrossingChar())
            ->setFinishChar($this->style->getCrossingChar())
        ;


        $rightUpperCorner = $this->leftUpperCorner->addWidth($this->size->getWidth());
        $leftBottomCorner = $this->leftUpperCorner->addHeight($this->size->getHeight());
        $rightBottomCorner = $rightUpperCorner->addHeight($this->size->getHeight());


        $top = (new Line($this->leftUpperCorner, $rightUpperCorner))->setStyle($horizontalLineStyle);
        $right = (new Line($rightUpperCorner, $rightBottomCorner))->setStyle($verticalLineStyle);
        $bottom = (new Line($rightBottomCorner, $leftBottomCorner))->setStyle($horizontalLineStyle);
        $left = (new Line($leftBottomCorner, $this->leftUpperCorner))->setStyle($verticalLineStyle);

        $this
            ->addFigure($top)
            ->addFigure($bottom)
            ->addFigure($left)
            ->addFigure($right);


        return parent::draw();
    }

    public function getStyle(): RectangleStyle
    {
        return $this->style;
    }

    public function setStyle(RectangleStyle $style): static
    {
        $this->style = $style;
        return $this;
    }

}
