<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Elements\Geometry\Rectangle;

use TextDraw\Common\Size;
use TextDraw\Figure\Elements\Geometry\Rectangle\Rectangle;
use TextDraw\Figure\Elements\Geometry\Rectangle\RectangleDrawer;
use TextDraw\Plane\Point;
use TextDraw\Tests\Figure\FigureTestCase;

class RectangleDrawerTest extends FigureTestCase
{
    private RectangleDrawer $drawer;
    public function setUp(): void
    {
        $this->drawer = new RectangleDrawer();
    }

    public function testRectangle(): void
    {
        $rectangle =
            new Rectangle(
                new Point(1, 1),
                new Size(3, 4)
            );

        $expected = <<<EOD
        ....
        .+-+
        .|.|
        .|.|
        .+-+
        EOD;

        $this->assertRender($expected, $this->drawer->draw($rectangle));
    }
}
