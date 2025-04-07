<?php

declare(strict_types=1);

namespace ConsoleDraw\Tests\Figure\Arrow;

use ConsoleDraw\Figure\Geometry\Arrow\Arrow;
use ConsoleDraw\Plane\Point;
use ConsoleDraw\Tests\Figure\FigureTestCase;

class ArrowTest extends FigureTestCase
{
    public function testHorizontalRightArrow(): void
    {
        $this->createDrawer(5, 3);
        $this->render->addFigure(new Arrow(
            new Point(1, 1),
            new Point(3, 1)
        ));
        $expected = <<<EOD
        .....
        .-->.
        .....
        EOD;

        $this->assertRender($expected);
    }

    public function testHorizontalLeftArrow(): void
    {
        $this->createDrawer(5, 3);
        $this->render->addFigure(new Arrow(
            new Point(3, 1),
            new Point(1, 1)
        ));
        $expected = <<<EOD
        .....
        .<--.
        .....
        EOD;

        $this->assertRender($expected);
    }

    public function testVerticalDownArrow(): void
    {
        $this->createDrawer(3, 4);
        $this->render->addFigure(new Arrow(
            new Point(1, 1),
            new Point(1, 3)
        ));
        $expected = <<<EOD
        ...
        .|.
        .|.
        .v.
        EOD;

        $this->assertRender($expected);
    }

    public function testVerticalUpArrow(): void
    {
        $this->createDrawer(3, 4);
        $this->render->addFigure(new Arrow(
            new Point(1, 3),
            new Point(1, 1)
        ));
        $expected = <<<EOD
        ...
        .^.
        .|.
        .|.
        EOD;

        $this->assertRender($expected);
    }



}
