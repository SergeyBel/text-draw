<?php

declare(strict_types=1);

namespace ConsoleDraw\Tests\Figure\Geometry\Line;

use ConsoleDraw\Figure\Geometry\Line\Line;
use ConsoleDraw\Figure\Geometry\Line\LineStyle;
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

    public function testDiagonalLine(): void
    {
        $this->createDrawer(3, 3);
        $this->render->addFigure(new Line(new Point(0, 0), new Point(2, 2)));
        $expected = <<<EOD
        *..
        .*.
        ..*
        EOD;

        $this->assertRender($expected);
    }

    public function testStyleSymbol(): void
    {
        $this->createDrawer(3, 3);

        $style = (new LineStyle())->setSymbol('+');
        $this->render->addFigure(
            (new Line(new Point(0, 0), new Point(2, 2)))
                ->setStyle($style)
        );
        $expected = <<<EOD
        +..
        .+.
        ..+
        EOD;

        $this->assertRender($expected);
    }

    public function testStyleStartFinishSymbol(): void
    {
        $this->createDrawer(3, 3);

        $style = (new LineStyle())
            ->setStartChar('+')
            ->setFinishChar('@');
        $this->render->addFigure(
            (new Line(new Point(0, 0), new Point(2, 2)))
                ->setStyle($style)
        );
        $expected = <<<EOD
        +..
        .*.
        ..@
        EOD;

        $this->assertRender($expected);
    }


}
