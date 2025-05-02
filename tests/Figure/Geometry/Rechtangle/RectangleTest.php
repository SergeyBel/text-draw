<?php

declare(strict_types=1);

namespace ConsoleDraw\Tests\Figure\Geometry\Rechtangle;

use ConsoleDraw\Common\Size;
use ConsoleDraw\Figure\Geometry\Rechtangle\Rectangle;
use ConsoleDraw\Plane\Point;
use ConsoleDraw\Tests\Figure\FigureTestCase;

class RectangleTest extends FigureTestCase
{
    public function testRectangle(): void
    {
        $this->addFigure(new Rectangle(
            new Point(1, 1),
            new Size(3, 4)
        ));
        $expected = <<<EOD
        ....
        .***
        .*.*
        .*.*
        .***
        EOD;

        $this->assertRender($expected);
    }
}
