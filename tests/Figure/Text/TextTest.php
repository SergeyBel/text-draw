<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Text;

use TextDraw\Common\HorizontalAlign;
use TextDraw\Figure\Text\Text;
use TextDraw\Figure\Text\TextStyle;
use TextDraw\Plane\Point;
use TextDraw\Tests\Figure\FigureTestCase;

class TextTest extends FigureTestCase
{
    public function testText(): void
    {
        $text = new Text(
            new Point(1, 1),
            'hello'
        )->setStyle($this->getStyle());

        $this->addFigure($text);

        $expected = <<<EOD
        ......
        .hello
        EOD;

        $this->assertRender($expected);
    }

    public function testStyleWidthLess(): void
    {
        $text = new Text(
            new Point(0, 0),
            'hello',
            3
        );
        $text->setStyle($this->getStyle());
        $this->addFigure($text);
        $expected = <<<EOD
        hel
        EOD;

        $this->assertRender($expected);
    }


    public function testAlignRight(): void
    {
        $text = new Text(
            new Point(0, 0),
            'hello',
            7
        );
        $text->setStyle(
            $this->getStyle()
                ->setAlign(HorizontalAlign::Right)
        );
        $this->addFigure($text);
        $expected = <<<EOD
        ..hello
        EOD;

        $this->assertRender($expected);
    }

    public function testAlignCenter(): void
    {

        $text = new Text(
            new Point(0, 0),
            'hello',
            7
        );
        $text->setStyle($this->getStyle()->setPaddingChar('-')->setAlign(HorizontalAlign::Center));
        $this->addFigure($text);
        $expected = <<<EOD
        -hello-
        EOD;

        $this->assertRender($expected);
    }

    public function testAlignCenterDifferentPaddding(): void
    {

        $text = new Text(
            new Point(0, 0),
            'hello',
            8
        );
        $text->setStyle($this->getStyle()->setPaddingChar('-')->setAlign(HorizontalAlign::Center));
        $this->addFigure($text);
        $expected = <<<EOD
        -hello--
        EOD;

        $this->assertRender($expected);
    }

    private function getStyle(): TextStyle
    {
        return new TextStyle()
                    ->setPaddingChar(null)
                    ->setAlign(HorizontalAlign::Left)
        ;
    }
}
