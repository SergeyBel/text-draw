<?php

declare(strict_types=1);

namespace TextDraw\Figure\Elements\Geometry\Rectangle;

use TextDraw\Figure\Elements\Geometry\Line\Line;
use TextDraw\Figure\Elements\Geometry\Line\LineDrawer;
use TextDraw\Screen\Pixel\Pixel;
use TextDraw\Screen\Screen;

class RectangleDrawer
{
    public function draw(Rectangle $rectangle): Screen
    {
        $leftUpperCorner = $rectangle->getLeftUpperCorner();
        $rightUpperCorner = $rectangle->getRightUpperCorner();
        $leftBottomCorner = $rectangle->getLeftBottomCorner();
        $rightBottomCorner = $rectangle->getRightBottomCorner();

        $lineDrawer = new LineDrawer();

        return new Screen()
            ->merge($lineDrawer->draw(new Line($leftBottomCorner, $leftUpperCorner)))
            ->merge($lineDrawer->draw(new Line($rightUpperCorner, $rightBottomCorner)))
            ->merge($lineDrawer->draw(new Line($leftUpperCorner, $rightUpperCorner)))
            ->merge($lineDrawer->draw(new Line($rightBottomCorner, $leftBottomCorner)))
            ->setPixel(new Pixel($leftUpperCorner, '+'))
            ->setPixel(new Pixel($rightUpperCorner, '+'))
            ->setPixel(new Pixel($leftBottomCorner, '+'))
            ->setPixel(new Pixel($rightBottomCorner, '+'))
        ;

    }

}
