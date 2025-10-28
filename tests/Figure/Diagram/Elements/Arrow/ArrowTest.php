<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Diagram\Elements\Arrow;

use TextDraw\Common\HorizontalAlign;
use TextDraw\Figure\Diagram\Elements\Arrow\Arrow;
use TextDraw\Figure\Diagram\Elements\Arrow\ArrowStyle;
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

    public function testRightBottom(): void
    {
        $this->addFigure(new Arrow(
            new Point(1, 0),
            new Point(2, 2)
        )->setStyle($this->getStyle()));
        $expected = <<<EOD
        .|.
        .|.
        .->
        EOD;

        $this->assertRender($expected);
    }

    public function testRightTop(): void
    {
        $this->addFigure(new Arrow(
            new Point(1, 2),
            new Point(2, 0)
        )->setStyle($this->getStyle()));
        $expected = <<<EOD
        .->
        .|.
        .|.
        EOD;

        $this->assertRender($expected);
    }

    public function testLeftBottom(): void
    {
        $this->addFigure(new Arrow(
            new Point(2, 0),
            new Point(1, 2)
        )->setStyle($this->getStyle()));
        $expected = <<<EOD
        ..|
        ..|
        .<-
        EOD;

        $this->assertRender($expected);
    }

    public function testLeftTop(): void
    {
        $this->addFigure(new Arrow(
            new Point(2, 2),
            new Point(1, 0)
        )->setStyle($this->getStyle()));
        $expected = <<<EOD
        .<-
        ..|
        ..|
        EOD;

        $this->assertRender($expected);
    }

    public function testText(): void
    {
        $this->addFigure(new Arrow(
            new Point(0, 1),
            new Point(3, 1),
            'hi'
        )->setStyle($this->getStyle()));
        $expected = <<<EOD
        .hi.
        --->
        EOD;

        $this->assertRender($expected);
    }

    public function testTextStyleAlign(): void
    {
        $this->addFigure(new Arrow(
            new Point(0, 1),
            new Point(3, 1),
            'hi'
        )->setStyle($this->getStyle()->setAlign(HorizontalAlign::Left)));
        $expected = <<<EOD
        hi..
        --->
        EOD;

        $this->assertRender($expected);
    }

    public function testStyleHorizontalChar(): void
    {
        $this->addFigure(
            new Arrow(
                new Point(1, 0),
                new Point(2, 2)
            )
                ->setStyle($this->getStyle()->setHorizontalChar('*'))
        );
        $expected = <<<EOD
        .|.
        .|.
        .*>
        EOD;

        $this->assertRender($expected);
    }

    public function testStyleVerticalChar(): void
    {
        $this->addFigure(
            new Arrow(
                new Point(1, 0),
                new Point(2, 2)
            )
                ->setStyle($this->getStyle()->setVerticalChar('*'))
        );
        $expected = <<<EOD
        .*.
        .*.
        .->
        EOD;

        $this->assertRender($expected);
    }


    private function getStyle(): ArrowStyle
    {
        return new ArrowStyle()
                        ->setVerticalChar('|')
                        ->setHorizontalChar('-')
                        ->setAlign(HorizontalAlign::Center);

    }
}
