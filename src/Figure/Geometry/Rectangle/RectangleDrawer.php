<?php

declare(strict_types=1);

namespace TextDraw\Figure\Geometry\Rectangle;

use TextDraw\Figure\Geometry\Line\Line;
use TextDraw\Figure\Geometry\Line\LineStyle;
use TextDraw\Screen\Screen;

class RectangleDrawer
{
    public function draw(RectangleData $rectangle, RectangleStyle $style): Screen
    {
        $leftUpperCorner = $rectangle->getLeftUpperCorner();
        $size = $rectangle->getSize();

        $horizontalLineStyle = new LineStyle()
            ->setChar($style->getHorizontalChar())
            ->setStartChar($style->getCrossingChar())
            ->setEndChar($style->getCrossingChar())
        ;

        $verticalLineStyle = new LineStyle()
            ->setChar($style->getVerticalChar())
            ->setStartChar($style->getCrossingChar())
            ->setEndChar($style->getCrossingChar())
        ;


        $rightUpperCorner = $leftUpperCorner->addWidth($size->getWidth());
        $leftBottomCorner = $leftUpperCorner->addHeight($size->getHeight());
        $rightBottomCorner = $rightUpperCorner->addHeight($size->getHeight());


        $top = new Line($leftUpperCorner, $rightUpperCorner)->setStyle($horizontalLineStyle);
        $right = new Line($rightUpperCorner, $rightBottomCorner)->setStyle($verticalLineStyle);
        $bottom = new Line($rightBottomCorner, $leftBottomCorner)->setStyle($horizontalLineStyle);
        $left = new Line($leftBottomCorner, $leftUpperCorner)->setStyle($verticalLineStyle);

        $screen = new Screen();
        return $screen
            ->addFigure($top)
            ->addFigure($bottom)
            ->addFigure($left)
            ->addFigure($right);
    }

}
