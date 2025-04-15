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

    public function testWidthLess(): void
    {
        $this->createDrawer(7, 1);
        $text = new Text(
            new Point(0, 0),
            'hello'
        );
        $text->setStyle((new TextStyle())->setWidth(3));
        $this->render->addFigure($text);
        $expected = <<<EOD
        hel....
        EOD;

        $this->assertRender($expected);
    }

    public function testWidthMore(): void
    {
        $this->createDrawer(7, 1);
        $text = new Text(
            new Point(0, 0),
            'hello'
        );
        $text->setStyle((new TextStyle())->setWidth(6));
        $this->render->addFigure($text);
        $expected = <<<EOD
        hello .
        EOD;

        $this->assertRender($expected);
    }

}
