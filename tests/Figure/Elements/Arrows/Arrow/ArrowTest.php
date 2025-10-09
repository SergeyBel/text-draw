<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Elements\Arrows\Arrow;

use TextDraw\Figure\Elements\Arrows\Arrow\Arrow;
use TextDraw\Figure\Elements\Arrows\Arrow\ArrowStyle;
use TextDraw\Plane\Point;
use TextDraw\Tests\Figure\FigureTestCase;

class ArrowTest extends FigureTestCase
{
    public function testHorizontalRightArrow(): void
    {
        $this->addFigure(new Arrow(
            new Point(1, 1),
            new Point(3, 1)
        )->setStyle($this->getStyle()));
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
        )->setStyle($this->getStyle()));
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
        )->setStyle($this->getStyle()));
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
        )->setStyle($this->getStyle()));
        $expected = <<<EOD
        ..
        .^
        .|
        .|
        EOD;

        $this->assertRender($expected);
    }

    public function testStyleChar(): void
    {
        $this->addFigure(new Arrow(
            new Point(1, 1),
            new Point(3, 1)
        )->setStyle($this->getStyle()->setChar('*')));
        $expected = <<<EOD
        ....
        .**>
        EOD;

        $this->assertRender($expected);
    }


    private function getStyle(): ArrowStyle
    {
        return new ArrowStyle()
                        ->setChar(null)
        ;
    }
}
