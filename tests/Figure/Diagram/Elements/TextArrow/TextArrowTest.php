<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Diagram\Elements\TextArrow;

use TextDraw\Figure\Diagram\Elements\TextArrow\TextArrow;
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
        );

        $this->addFigure($textArrow);


        $expected = <<<EOD
        .abc.
        ---->
        EOD;

        $this->assertRender($expected);
    }

}
