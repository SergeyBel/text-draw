<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Elements\Arrows\CornerArrow;

use TextDraw\Figure\Elements\Arrows\CornerArrow\CornerArrow;
use TextDraw\Figure\Elements\Arrows\CornerArrow\CornerArrowStyle;
use TextDraw\Plane\Point;
use TextDraw\Tests\Figure\FigureTestCase;

class CornerArrowTest extends FigureTestCase
{
    public function testRightBottom(): void
    {
        $this->addFigure(new CornerArrow(
            new Point(1, 0),
            new Point(2, 2)
        )->setStyle($this->getSTyle()));
        $expected = <<<EOD
        .--
        ..|
        ..v
        EOD;

        $this->assertRender($expected);
    }

    public function testRightTop(): void
    {
        $this->addFigure(new CornerArrow(
            new Point(1, 2),
            new Point(2, 0)
        )->setStyle($this->getSTyle()));
        $expected = <<<EOD
        ..^
        ..|
        .--
        EOD;

        $this->assertRender($expected);
    }

    public function testLeftBottom(): void
    {
        $this->addFigure(new CornerArrow(
            new Point(2, 0),
            new Point(1, 2)
        )->setStyle($this->getSTyle()));
        $expected = <<<EOD
        .--
        .|.
        .v.
        EOD;

        $this->assertRender($expected);
    }

    public function testLeftTop(): void
    {
        $this->addFigure(new CornerArrow(
            new Point(2, 2),
            new Point(1, 0)
        )->setStyle($this->getSTyle()));
        $expected = <<<EOD
        .^.
        .|.
        .--
        EOD;

        $this->assertRender($expected);
    }

    public function testStyleHorizontalChar(): void
    {
        $this->addFigure(
            new CornerArrow(
                new Point(1, 0),
                new Point(2, 2)
            )
            ->setStyle($this->getSTyle()->setHorizontalChar('*'))
        );
        $expected = <<<EOD
        .**
        ..|
        ..v
        EOD;

        $this->assertRender($expected);
    }

    public function testStyleVerticalChar(): void
    {
        $this->addFigure(
            new CornerArrow(
                new Point(1, 0),
                new Point(2, 2)
            )
            ->setStyle($this->getSTyle()->setVerticalChar('*'))
        );
        $expected = <<<EOD
        .--
        ..*
        ..v
        EOD;

        $this->assertRender($expected);
    }

    private function getStyle(): CornerArrowStyle
    {
        return new CornerArrowStyle()
            ->setHorizontalChar('-')
            ->setVerticalChar('|');
    }

}
