<?php

declare(strict_types=1);

namespace ConsoleDraw\Tests\Figure\Text;

use ConsoleDraw\Figure\Text\Text;
use ConsoleDraw\Plane\Point;
use ConsoleDraw\Tests\Figure\FigureTestCase;

class TextTest extends FigureTestCase
{
    public function testRectangle(): void
    {
        $this->createDrawer(7, 3);
        $this->drawer->addFigure(new Text(
            new Point(1, 2),
            'hello'
        ));
        $expected = <<<EOD
        .......
        .......
        .hello.
        EOD;

        $this->assertRender($expected);
    }

}
