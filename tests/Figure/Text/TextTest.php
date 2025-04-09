<?php

declare(strict_types=1);

namespace ConsoleDraw\Tests\Figure\Text;

use ConsoleDraw\Figure\Text\Text;
use ConsoleDraw\Plane\Point;
use ConsoleDraw\Tests\Figure\FigureTestCase;

class TextTest extends FigureTestCase
{
    public function testText(): void
    {
        $this->createDrawer(7, 2);
        $this->render->addFigure(new Text(
            new Point(1, 1),
            'hello'
        ));
        $expected = <<<EOD
        .......
        .hello.
        EOD;

        $this->assertRender($expected);
    }

}
