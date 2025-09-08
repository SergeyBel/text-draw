<?php

declare(strict_types=1);

namespace TextDraw\Tests\Screen;

use TextDraw\Common\Size;
use TextDraw\Figure\Geometry\Rectangle\Rectangle;
use TextDraw\Figure\Geometry\Rectangle\RectangleStyle;
use TextDraw\Figure\Pixel\Pixel;
use TextDraw\Plane\Point;
use TextDraw\Screen\ScreenBuilder;
use TextDraw\Tests\Figure\FigureTestCase;

class ScreenBuilderTest extends FigureTestCase
{
    public function testSeveralFigures(): void
    {
        $builder = new ScreenBuilder();

        $screen = $builder
            ->addFigure(new Rectangle(
                new Point(0, 0),
                new Size(4, 3)
            )->setStyle(new RectangleStyle()->setChar('*')))
            ->rotate()
            ->addFigure(new Pixel(new Point(0, 0), '@'))
            ->move(1, 1)
            ->build()
        ;


        $this->setScreen($screen);
        $expected = <<<EOD
        ***
        *@*
        *.*
        ***
        EOD;

        $this->assertRender($expected);
    }
}
