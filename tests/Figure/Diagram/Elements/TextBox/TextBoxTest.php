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

    public function testGetLeftBottomCorner(): void
    {
        $textBox = new TextBox(
            'test',
            new Point(0, 0),
            new Size(2, 5)
        );
        $point = $textBox->getLeftBottomCorner();
        $this->assertEquals(0, $point->getX());
        $this->assertEquals(4, $point->getY());
    }

    public function testGetRightUpperCorner(): void
    {
        $textBox = new TextBox(
            'test',
            new Point(0, 0),
            new Size(2, 5)
        );
        $point = $textBox->getRightUpperCorner();
        $this->assertEquals(1, $point->getX());
        $this->assertEquals(0, $point->getY());
    }

    public function testGetRightBottomCorner(): void
    {
        $textBox = new TextBox(
            'test',
            new Point(0, 0),
            new Size(2, 5)
        );
        $point = $textBox->getRightBottomCorner();
        $this->assertEquals(1, $point->getX());
        $this->assertEquals(4, $point->getY());
    }

    public function testGetUpperCenter(): void
    {
        $textBox = new TextBox(
            'test',
            new Point(0, 0),
            new Size(3, 6)
        );
        $point = $textBox->getUpperCenter();
        $this->assertEquals(1, $point->getX());
        $this->assertEquals(0, $point->getY());
    }

    public function testGetBottomCenter(): void
    {
        $textBox = new TextBox(
            'test',
            new Point(0, 0),
            new Size(3, 6)
        );
        $point = $textBox->getBottomCenter();
        $this->assertEquals(1, $point->getX());
        $this->assertEquals(5, $point->getY());
    }

    public function testGetLeftCenter(): void
    {
        $textBox = new TextBox(
            'test',
            new Point(0, 0),
            new Size(3, 6)
        );
        $point = $textBox->getLeftCenter();
        $this->assertEquals(0, $point->getX());
        $this->assertEquals(2, $point->getY());
    }

    public function testGetRightCenter(): void
    {
        $textBox = new TextBox(
            'test',
            new Point(0, 0),
            new Size(3, 6)
        );
        $point = $textBox->getRightCenter();
        $this->assertEquals(2, $point->getX());
        $this->assertEquals(2, $point->getY());
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
