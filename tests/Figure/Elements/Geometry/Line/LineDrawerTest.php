<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Elements\Geometry\Line;

use TextDraw\Figure\Elements\Geometry\Line\Line;
use TextDraw\Figure\Elements\Geometry\Line\LineDrawer;
use TextDraw\Plane\Point;
use TextDraw\Tests\Figure\FigureTestCase;

class LineDrawerTest extends FigureTestCase
{
    private LineDrawer $drawer;
    public function setUp(): void
    {
        $this->drawer = new LineDrawer();
    }

    public function testHorizontalLine(): void
    {
        $line = new Line(new Point(0, 0), new Point(2, 0));

        $expected = <<<EOD
        ---
        EOD;

        $this->assertRender($expected, $this->drawer->draw($line));
    }

    public function testVerticalLine(): void
    {
        $line = new Line(new Point(0, 0), new Point(0, 2));
        $expected = <<<EOD
        |
        |
        |
        EOD;

        $this->assertRender($expected, $this->drawer->draw($line));
    }

    public function testDiagonalRightLine(): void
    {
        $line = new Line(new Point(0, 0), new Point(2, 2));

        $expected = <<<EOD
        \..
        .\.
        ..\
        EOD;

        $this->assertRender($expected, $this->drawer->draw($line));
    }

    public function testDiagonalLeftLine(): void
    {
        $line =
            new Line(new Point(2, 0), new Point(0, 2));

        $expected = <<<EOD
        ../
        ./.
        /..
        EOD;

        $this->assertRender($expected, $this->drawer->draw($line));
    }
}
