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
        $this->addFigure(new Line(new Point(0, 0), new Point(2, 0)));
        $expected = <<<EOD
        ***
        EOD;

        $this->assertRender($expected);
    }

    public function testVerticalLine(): void
    {

        $this->addFigure(new Line(new Point(0, 0), new Point(0, 2)));
        $expected = <<<EOD
        *
        *
        *
        EOD;

        $this->assertRender($expected);
    }

    public function testDiagonalLine(): void
    {

        $this->addFigure(new Line(new Point(0, 0), new Point(2, 2)));
        $expected = <<<EOD
        *..
        .*.
        ..*
        EOD;

        $this->assertRender($expected);
    }

    public function testStyleSymbol(): void
    {

        $style = (new LineStyle())->setSymbol('+');
        $this->addFigure(
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

        $style = (new LineStyle())
            ->setStartChar('+')
            ->setFinishChar('@');
        $this->addFigure(
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
