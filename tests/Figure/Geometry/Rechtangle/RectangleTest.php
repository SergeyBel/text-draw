<?php

declare(strict_types=1);

namespace ConsoleDraw\Tests\Figure\Geometry\Rechtangle;

use ConsoleDraw\Figure\Geometry\Rechtangle\Rectangle;
use ConsoleDraw\Figure\Geometry\Rechtangle\RectangleStyle;
use ConsoleDraw\Plane\Point;
use ConsoleDraw\Plane\Size;
use ConsoleDraw\Tests\Figure\FigureTestCase;

class RectangleTest extends FigureTestCase
{
    public function testRectangle(): void
    {
        $this->createDrawer(5, 5);
        $this->render->addFigure(new Rectangle(
            new Point(1, 1),
            new Size(3, 4)
        ));
        $expected = <<<EOD
        .....
        .***.
        .*.*.
        .*.*.
        .***.
        EOD;

        $this->assertRender($expected);
    }

    public function testStyleSymbol(): void
    {
        $this->createDrawer(3, 3);
        $style = (new RectangleStyle())->setSymbol('@');
        $this->render->addFigure(
            (new Rectangle(
                new Point(0, 0),
                new Size(3, 3)
            ))->setStyle($style)
        );
        $expected = <<<EOD
        @@@
        @.@
        @@@
        EOD;

        $this->assertRender($expected);
    }

    public function testStyleCorner(): void
    {
        $this->createDrawer(3, 3);
        $style = (new RectangleStyle())->setCornerSymbol('+');
        $this->render->addFigure(
            (new Rectangle(
                new Point(0, 0),
                new Size(3, 3)
            ))->setStyle($style)
        );
        $expected = <<<EOD
        +*+
        *.*
        +*+
        EOD;

        $this->assertRender($expected);
    }

}
