<?php

declare(strict_types=1);

namespace ConsoleDraw\Tests\Figure;

use ConsoleDraw\Render\TextRender\TextRender;
use ConsoleDraw\Render\TextRender\TextRenderStyle;
use PHPUnit\Framework\TestCase;

class FigureTestCase extends TestCase
{
    protected TextRender $drawer;

    protected function createDrawer(int $width, int $height, string $emptySymbol = '.'): void
    {
        $this->drawer = (new TextRender($width, $height))
            ->setStyle(
                (new TextRenderStyle())
                    ->setEmptySymbol($emptySymbol)
            );
    }

    protected function assertRender(string $expected)
    {
        $this->assertSame($expected, $this->drawer->render());
    }

}
