<?php

declare(strict_types=1);

namespace ConsoleDraw\Tests\Figure\Geometry\Triangle;

use ConsoleDraw\Figure\Geometry\Triangle\Triangle;
use ConsoleDraw\Plane\Point;
use ConsoleDraw\Tests\Figure\FigureTestCase;

class TriangleTest extends FigureTestCase
{
    public function testTriangle(): void
    {
        $this->createDrawer(5, 5);
        $this->drawer->addFigure(new Triangle(
            new Point(1, 1),
            new Point(1, 4),
            new Point(4, 4)
        ));
        $expected = <<<EOD
        .....
        .*...
        .**..
        .*.*.
        .****
        EOD;

        $this->assertRender($expected);
    }

}
