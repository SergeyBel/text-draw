<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Geometry\Triangle;

use TextDraw\Figure\Geometry\Triangle\Triangle;
use TextDraw\Plane\Point;
use TextDraw\Tests\Figure\FigureTestCase;

class TriangleTest extends FigureTestCase
{
    public function testTriangle(): void
    {
        $this->addFigure(new Triangle(
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
