<?php

declare(strict_types=1);

namespace ConsoleDraw\Tests\Figure\Geometry\Line;

use ConsoleDraw\Figure\Geometry\Line\Line;
use ConsoleDraw\Plane\Point;
use ConsoleDraw\Tests\Figure\FigureTestCase;

class LineTest extends FigureTestCase
{
    public function testHorizontalLine(): void
    {
        $this->createDrawer(5, 5);
        $this->render->addFigure(new Line(new Point(0, 0), new Point(2, 0)));
        $expected = <<<EOD
        ***..
        .....
        .....
        .....
        .....
        EOD;

        $this->assertRender($expected);
    }

    public function testVerticalLine(): void
    {
        $this->createDrawer(5, 5);
        $this->render->addFigure(new Line(new Point(0, 0), new Point(0, 2)));
        $expected = <<<EOD
        *....
        *....
        *....
        .....
        .....
        EOD;

        $this->assertRender($expected);
    }
}
