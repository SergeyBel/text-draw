<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Diagram\Elements\TextBox;

use TextDraw\Figure\Diagram\Elements\TextBox\TextBox;
use TextDraw\Plane\Point;
use TextDraw\Tests\Figure\FigureTestCase;
use TextDraw\Figure\Diagram\Elements\TextBox\TextBoxStyle;

class TextBoxTest extends FigureTestCase
{
    public function testTextBox(): void
    {
        $textBox = new TextBox(
            'abc',
            new Point(0, 0),
        )->setStyle($this->getStyle());

        $this->addFigure($textBox);


        $expected = <<<EOD
        +-----+
        |.abc.|
        +-----+
        EOD;

        $this->assertRender($expected);
    }

    private function getStyle(): TextBoxStyle
    {
        return new TextBoxStyle();
    }

}
