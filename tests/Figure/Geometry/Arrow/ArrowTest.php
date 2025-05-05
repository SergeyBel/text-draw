<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Geometry\Arrow;

use TextDraw\Figure\Geometry\Arrow\Arrow;
use TextDraw\Plane\Point;
use TextDraw\Tests\Figure\FigureTestCase;

class ArrowTest extends FigureTestCase
{
    public function testHorizontalRightArrow(): void
    {
        $this->addFigure(new Arrow(
            new Point(1, 1),
            new Point(3, 1)
        ));
        $expected = <<<EOD
        ....
        .-->
        EOD;

        $this->assertRender($expected);
    }

    public function testHorizontalLeftArrow(): void
    {
        $this->addFigure(new Arrow(
            new Point(3, 1),
            new Point(1, 1)
        ));
        $expected = <<<EOD
        ....
        .<--
        EOD;

        $this->assertRender($expected);
    }

    public function testVerticalDownArrow(): void
    {
        $this->addFigure(new Arrow(
            new Point(1, 1),
            new Point(1, 3)
        ));
        $expected = <<<EOD
        ..
        .|
        .|
        .v
        EOD;

        $this->assertRender($expected);
    }

    public function testVerticalUpArrow(): void
    {
        $this->addFigure(new Arrow(
            new Point(1, 3),
            new Point(1, 1)
        ));
        $expected = <<<EOD
        ..
        .^
        .|
        .|
        EOD;

        $this->assertRender($expected);
    }
}
