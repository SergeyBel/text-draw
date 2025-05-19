<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Diagram\Elements\TextBox;

use TextDraw\Figure\Diagram\Elements\TextBox\TextBox;
use TextDraw\Plane\Point;
use TextDraw\Tests\Figure\FigureTestCase;

class TextBoxTest extends FigureTestCase
{
    public function testTextBox(): void
    {
        $textBox = new TextBox(
            'abc',
            new Point(0, 0),
        );

        $this->addFigure($textBox);


        $expected = <<<EOD
        +-----+
        |.abc.|
        +-----+
        EOD;

        $this->assertRender($expected);
    }

}
