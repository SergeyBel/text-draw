<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Geometry\Line;

use TextDraw\Figure\Geometry\Line\Line;
use TextDraw\Figure\Geometry\Line\LineStyle;
use TextDraw\Plane\Point;
use TextDraw\Tests\Figure\FigureTestCase;

class LineTest extends FigureTestCase
{
    public function testHorizontalLine(): void
    {
        $this->addFigure(
            new Line(new Point(0, 0), new Point(2, 0))
                    ->setStyle($this->getStyle())
        );
        $expected = <<<EOD
        ***
        EOD;

        $this->assertRender($expected);
    }

    public function testVerticalLine(): void
    {
        $this->addFigure(
            new Line(new Point(0, 0), new Point(0, 2))
                    ->setStyle($this->getStyle())
        );
        $expected = <<<EOD
        *
        *
        *
        EOD;

        $this->assertRender($expected);
    }

    public function testDiagonalRightLine(): void
    {
        $this->addFigure(
            new Line(new Point(0, 0), new Point(2, 2))
                     ->setStyle($this->getStyle())
        );
        $expected = <<<EOD
        *..
        .*.
        ..*
        EOD;

        $this->assertRender($expected);
    }

    public function testDiagonalLeftLine(): void
    {
        $this->addFigure(
            new Line(new Point(2, 0), new Point(0, 2))
                ->setStyle($this->getStyle())
        );
        $expected = <<<EOD
        ..*
        .*.
        *..
        EOD;

        $this->assertRender($expected);
    }


    private function getStyle(): LineStyle
    {
        return new LineStyle()
                        ->setChar('*')
                        ->setStartChar(null)
                        ->setEndChar(null)
        ;

    }
}
