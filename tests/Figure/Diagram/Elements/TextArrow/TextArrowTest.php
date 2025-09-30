<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Diagram\Elements\TextArrow;

use TextDraw\Figure\Diagram\Elements\TextArrow\TextArrow;
use TextDraw\Plane\Point;
use TextDraw\Tests\Figure\FigureTestCase;
use TextDraw\Figure\Diagram\Elements\TextArrow\TextArrowStyle;
use TextDraw\Figure\Diagram\Elements\Arrow\ArrowStyle;

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
