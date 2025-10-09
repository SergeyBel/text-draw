<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Elements\Arrows\TextArrow;

use TextDraw\Figure\Elements\Arrows\Arrow\ArrowStyle;
use TextDraw\Figure\Elements\Arrows\TextArrow\TextArrow;
use TextDraw\Figure\Elements\Arrows\TextArrow\TextArrowStyle;
use TextDraw\Plane\Point;
use TextDraw\Tests\Figure\FigureTestCase;

class TextArrowTest extends FigureTestCase
{
    public function testTextArrow(): void
    {
        $textArrow = new TextArrow(
            'abc',
            new Point(0, 1),
            new Point(4, 1)
        )->setStyle($this->getStyle());

        $this->addFigure($textArrow);


        $expected = <<<EOD
        .abc.
        ---->
        EOD;

        $this->assertRender($expected);
    }

    public function testStyleArrow(): void
    {
        $textArrow = new TextArrow(
            'abc',
            new Point(0, 1),
            new Point(4, 1)
        )->setStyle($this->getStyle()->setArrowStyle(new ArrowStyle()->setChar('*')));

        $this->addFigure($textArrow);


        $expected = <<<EOD
        .abc.
        ****>
        EOD;

        $this->assertRender($expected);
    }

    private function getStyle(): TextArrowStyle
    {
        return new TextArrowStyle()
                    ->setArrowStyle(new ArrowStyle()->setChar(null))
        ;
    }

}
