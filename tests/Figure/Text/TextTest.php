<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Text;

use TextDraw\Figure\Text\Text;
use TextDraw\Figure\Text\TextAlign;
use TextDraw\Figure\Text\TextStyle;
use TextDraw\Plane\Point;
use TextDraw\Tests\Figure\FigureTestCase;

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
        $text->setStyle(new TextStyle()->setWidth(3));
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
        $text->setStyle(new TextStyle()->setWidth(6));
        $this->addFigure($text);
        $expected = <<<EOD
        hello 
        EOD;

        $this->assertRender($expected);
    }

    public function testAlignCenter(): void
    {
        $text = new Text(
            new Point(0, 0),
            'hello'
        );
        $text->setStyle(
            new TextStyle()
                ->setWidth(7)
                ->setAlign(TextAlign::Center)
        );
        $this->addFigure($text);

        $expected = <<<EOD
         hello 
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
            new TextStyle()
                ->setWidth(7)
                ->setAlign(TextAlign::Right)
        );
        $this->addFigure($text);
        $expected = <<<EOD
        .  hello
        EOD;

        $this->assertRender($expected);
    }
}
