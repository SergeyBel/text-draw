<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Diagram\Elements\TextBox;

use TextDraw\Common\HorizontalAlign;
use TextDraw\Common\Size;
use TextDraw\Common\VerticalAlign;
use TextDraw\Figure\Diagram\Elements\TextBox\TextBox;
use TextDraw\Figure\Diagram\Elements\TextBox\TextBoxStyle;
use TextDraw\Figure\Geometry\Rectangle\RectangleStyle;
use TextDraw\Plane\Point;
use TextDraw\Tests\Figure\FigureTestCase;

class TextBoxTest extends FigureTestCase
{
    public function testTextBox(): void
    {
        $textBox = new TextBox(
            'abc',
            new Point(0, 0),
            new Size(7, 3)
        )->setStyle($this->getStyle());

        $this->addFigure($textBox);


        $expected = <<<EOD
        +-----+
        |.abc.|
        +-----+
        EOD;

        $this->assertRender($expected);
    }

    public function testStyleTextVerticalAlignTop(): void
    {
        $textBox = new TextBox(
            'abc',
            new Point(0, 0),
            new Size(7, 5)
        )->setStyle($this->getStyle()->setTextVerticalAlign(VerticalAlign::Top));

        $this->addFigure($textBox);


        $expected = <<<EOD
        +-----+
        |.abc.|
        |.....|
        |.....|
        +-----+
        EOD;


        $this->assertRender($expected);
    }

    public function testStyleTextVerticalAlignCenter(): void
    {
        $textBox = new TextBox(
            'abc',
            new Point(0, 0),
            new Size(7, 5)
        )->setStyle($this->getStyle()->setTextVerticalAlign(VerticalAlign::Center));

        $this->addFigure($textBox);


        $expected = <<<EOD
        +-----+
        |.....|
        |.abc.|
        |.....|
        +-----+
        EOD;

        $this->assertRender($expected);
    }

    public function testStyleTextVerticalAlignBottom(): void
    {
        $textBox = new TextBox(
            'abc',
            new Point(0, 0),
            new Size(7, 5)
        )->setStyle($this->getStyle()->setTextVerticalAlign(VerticalAlign::Bottom));

        $this->addFigure($textBox);


        $expected = <<<EOD
        +-----+
        |.....|
        |.....|
        |.abc.|
        +-----+
        EOD;

        $this->assertRender($expected);
    }


    public function testStyleTextHorizontalAlignLeft(): void
    {
        $textBox = new TextBox(
            'abc',
            new Point(0, 0),
            new Size(7, 5)
        )->setStyle($this->getStyle()->setTextHorizontalAlign(HorizontalAlign::Left));

        $this->addFigure($textBox);


        $expected = <<<EOD
        +-----+
        |.....|
        |abc..|
        |.....|
        +-----+
        EOD;

        $this->assertRender($expected);
    }

    public function testStyleTextHorizontalAlignCenter(): void
    {
        $textBox = new TextBox(
            'abc',
            new Point(0, 0),
            new Size(7, 5)
        )->setStyle($this->getStyle()->setTextHorizontalAlign(HorizontalAlign::Center));

        $this->addFigure($textBox);


        $expected = <<<EOD
        +-----+
        |.....|
        |.abc.|
        |.....|
        +-----+
        EOD;

        $this->assertRender($expected);
    }

    public function testStyleTextHorizontalAlignRight(): void
    {
        $textBox = new TextBox(
            'abc',
            new Point(0, 0),
            new Size(7, 5)
        )->setStyle($this->getStyle()->setTextHorizontalAlign(HorizontalAlign::Right));

        $this->addFigure($textBox);


        $expected = <<<EOD
        +-----+
        |.....|
        |..abc|
        |.....|
        +-----+
        EOD;

        $this->assertRender($expected);
    }


    private function getStyle(): TextBoxStyle
    {
        return new TextBoxStyle()
                    ->setTextHorizontalAlign(HorizontalAlign::Center)
                    ->setTextVerticalAlign(VerticalAlign::Center)
                    ->setRectangleStyle(
                        new RectangleStyle()
                                ->setHorizontalChar('-')
                                ->setVerticalChar('|')
                                ->setCrossingChar('+')
                    )

        ;
    }

}
