<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Geometry\Rechtangle;

use TextDraw\Common\Size;
use TextDraw\Figure\Geometry\Rechtangle\Rectangle;
use TextDraw\Plane\Point;
use TextDraw\Tests\Figure\FigureTestCase;

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
