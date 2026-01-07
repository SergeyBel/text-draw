<?php

declare(strict_types=1);

namespace TextDraw\Figure\Geometry\Triangle;

use TextDraw\Figure\Geometry\Line\Line;
use TextDraw\Figure\Geometry\Line\LineStyle;
use TextDraw\Screen\Screen;

class TriangleDrawer
{
    public function draw(TriangleData $triangle, TriangleStyle $style): Screen
    {
        $lineStyle = new LineStyle()->setChar($style->getChar());
        return new Screen()
            ->addFigure(new Line($triangle->getVertex1(), $triangle->getVertex2())->setStyle($lineStyle))
            ->addFigure(new Line($triangle->getVertex2(), $triangle->getVertex3())->setStyle($lineStyle))
            ->addFigure(new Line($triangle->getVertex3(), $triangle->getVertex1())->setStyle($lineStyle));

    }

}
