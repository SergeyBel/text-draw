<?php

declare(strict_types=1);

namespace ConsoleDraw\Tests\Figure\Text;

use ConsoleDraw\Figure\Text\Text;
use ConsoleDraw\Figure\Text\TextStyle;
use ConsoleDraw\Plane\Point;
use ConsoleDraw\Tests\Figure\FigureTestCase;

class TextTest extends FigureTestCase
{
    public function testText(): void
    {
        $this->addFigure(new Text(
            new Point(1, 1),
            'hello'
        ));
        $expected = <<<EOD
        ......
        .hello
        EOD;

        $this->assertRender($expected);
    }

    public function testWidthLess(): void
    {
        $text = new Text(
            new Point(0, 0),
            'hello'
        );
        $text->setStyle((new TextStyle())->setWidth(3));
        $this->addFigure($text);
        $expected = <<<EOD
        hel
        EOD;

        $this->assertRender($expected);
    }

    public function testWidthMore(): void
    {

        $text = new Text(
            new Point(0, 0),
            'hello'
        );
        $text->setStyle((new TextStyle())->setWidth(6));
        $this->addFigure($text);
        $expected = <<<EOD
        hello 
        EOD;

        $this->assertRender($expected);
    }

    public function testAlignCenter(): void
    {
        $text = new Text(
            new Point(1, 0),
            'hello'
        );
        $text->setStyle(
            (new TextStyle())
                ->setWidth(7)
                ->alignCenter()
        );
        $this->addFigure($text);
        $expected = <<<EOD
        . hello 
        EOD;

        $this->assertRender($expected);
    }

    public function testAlignRight(): void
    {
        $text = new Text(
            new Point(1, 0),
            'hello'
        );
        $text->setStyle(
            (new TextStyle())
                ->setWidth(7)
                ->alignRight()
        );
        $this->addFigure($text);
        $expected = <<<EOD
        .  hello
        EOD;

        $this->assertRender($expected);
    }
}
