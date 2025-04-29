<?php

declare(strict_types=1);

namespace ConsoleDraw\Tests\Figure;

use ConsoleDraw\Common\Size;
use ConsoleDraw\Render\TextRender\TextRender;
use ConsoleDraw\Render\TextRender\TextRenderStyle;
use ConsoleDraw\Tests\RenderConstraint;
use PHPUnit\Framework\TestCase;

class FigureTestCase extends TestCase
{
    protected TextRender $render;

    protected function createDrawer(?Size $size = null, string $emptySymbol = '.'): void
    {
        $this->render = (new TextRender($size))
            ->setStyle(
                (new TextRenderStyle())
                    ->setEmptyChar($emptySymbol)
            );
    }

    protected function assertRender(string $expected)
    {
        $actual = $this->render->render();
        $message = "Expected:\n" . $expected . "\n\nActual:\n" . $actual;

        $this->assertThat($actual, new RenderConstraint($expected), $message);
    }

}
