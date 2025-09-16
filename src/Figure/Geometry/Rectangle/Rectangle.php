<?php

declare(strict_types=1);

namespace TextDraw\Figure\Geometry\Rectangle;

use TextDraw\Common\Size;
use TextDraw\Figure\Base\BaseFigure;
use TextDraw\Figure\Geometry\Line\Line;
use TextDraw\Figure\Geometry\Line\LineStyle;
use TextDraw\Plane\Point;
use TextDraw\Screen\Screen;

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

    public function getScreen(): Screen
    {

        $horizontalLineStyle = new LineStyle()
                ->setChar($this->style->getHorizontalChar())
                ->setStartChar($this->style->getCrossingChar())
                ->setFinishChar($this->style->getCrossingChar())
        ;

        $verticalLineStyle = new LineStyle()
            ->setChar($this->style->getVerticalChar())
            ->setStartChar($this->style->getCrossingChar())
            ->setFinishChar($this->style->getCrossingChar())
        ;


        $rightUpperCorner = $this->leftUpperCorner->addWidth($this->size->getWidth());
        $leftBottomCorner = $this->leftUpperCorner->addHeight($this->size->getHeight());
        $rightBottomCorner = $rightUpperCorner->addHeight($this->size->getHeight());


        $top = new Line($this->leftUpperCorner, $rightUpperCorner)->setStyle($horizontalLineStyle);
        $right = new Line($rightUpperCorner, $rightBottomCorner)->setStyle($verticalLineStyle);
        $bottom = new Line($rightBottomCorner, $leftBottomCorner)->setStyle($horizontalLineStyle);
        $left = new Line($leftBottomCorner, $this->leftUpperCorner)->setStyle($verticalLineStyle);

        $this
            ->addFigure($top)
            ->addFigure($bottom)
            ->addFigure($left)
            ->addFigure($right);


        return parent::getScreen();
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
