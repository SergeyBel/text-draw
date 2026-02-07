<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure\Text;

use TextDraw\Common\HorizontalAlign;
use TextDraw\Figure\Text\Text;
use TextDraw\Figure\Text\TextDrawer;
use TextDraw\Plane\Point;
use TextDraw\Tests\Figure\FigureTestCase;

class TextDrawerTest extends FigureTestCase
{
    private TextDrawer $drawer;

    public function setUp(): void
    {
        $this->drawer = new TextDrawer();
    }
    public function testText(): void
    {
        $text = new Text(
            new Point(1, 1),
            'hello'
        );


        $expected = <<<EOD
        ......
        .hello
        EOD;

        $this->assertRender($expected, $this->drawer->draw($text));
    }

    public function testWidthLess(): void
    {
        $text = new Text(
            new Point(0, 0),
            'hello',
            3
        );


        $expected = <<<EOD
        hel
        EOD;

        $this->assertRender($expected, $this->drawer->draw($text));
    }


    public function testAlignRight(): void
    {
        $text = new Text(
            new Point(0, 0),
            'hello',
            7,
            HorizontalAlign::Right
        );

        $expected = <<<EOD
        ..hello
        EOD;

        $this->assertRender($expected, $this->drawer->draw($text));
    }

    public function testAlignCenter(): void
    {
        $text = new Text(
            new Point(0, 0),
            'hello',
            7,
            HorizontalAlign::Center
        );


        $expected = <<<EOD
        .hello
        EOD;

        $this->assertRender($expected, $this->drawer->draw($text));
    }

}
