<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Geometry\Rectangle;

use TextDraw\Figure\Geometry\Rectangle\Rectangle;
use TextDraw\Tests\Figure\FigureTestCase;
use TextDraw\Figure\Geometry\Rectangle\RectangleStyle;

class RectangleTest extends FigureTestCase
{
    public function testRectangle(): void
    {
        $this->addFigure(
            new Rectangle(
                1,
                1,
                3,
                4
            )->setStyle($this->getStyle())
        );
        $expected = <<<EOD
        ....
        .+-+
        .|.|
        .|.|
        .+-+
        EOD;

        $this->assertRender($expected);
    }

    public function testStyleVerticalChar(): void
    {
        $this->addFigure(
            new Rectangle(
                1,
                1,
                3,
                4
            )->setStyle($this->getStyle()->setVerticalChar('*'))
        );
        $expected = <<<EOD
        ....
        .+-+
        .*.*
        .*.*
        .+-+
        EOD;

        $this->assertRender($expected);
    }


    public function testStyleHorizontalChar(): void
    {
        $this->addFigure(
            new Rectangle(
                1,
                1,
                3,
                4
            )->setStyle($this->getStyle()->setHorizontalChar('*'))
        );
        $expected = <<<EOD
        ....
        .+*+
        .|.|
        .|.|
        .+*+
        EOD;

        $this->assertRender($expected);
    }

    public function testStyleCrossingChar(): void
    {
        $this->addFigure(
            new Rectangle(
                1,
                1,
                3,
                4
            )->setStyle($this->getStyle()->setCrossingChar('*'))
        );
        $expected = <<<EOD
        ....
        .*-*
        .|.|
        .|.|
        .*-*
        EOD;

        $this->assertRender($expected);
    }

    public function testStyleChar(): void
    {
        $this->addFigure(
            new Rectangle(
                1,
                1,
                3,
                4
            )->setStyle($this->getStyle()->setChar('*'))
        );
        $expected = <<<EOD
        ....
        .***
        .*.*
        .*.*
        .***
        EOD;

        $this->assertRender($expected);
    }

    private function getStyle(): RectangleStyle
    {
        return new RectangleStyle()
                        ->setHorizontalChar('-')
                        ->setVerticalChar('|')
                        ->setCrossingChar('+')
        ;
    }
}
