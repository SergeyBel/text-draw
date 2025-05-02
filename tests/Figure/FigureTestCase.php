<?php

declare(strict_types=1);

namespace ConsoleDraw\Tests\Figure;

use ConsoleDraw\Figure\Base\FigureInterface;
use ConsoleDraw\Frame\Frame;
use ConsoleDraw\Render\TextRender\TextRender;
use ConsoleDraw\Render\TextRender\TextRenderStyle;
use ConsoleDraw\Tests\RenderConstraint;
use PHPUnit\Framework\TestCase;

class FigureTestCase extends TestCase
{
    protected TextRender $render;

    protected Frame $frame;

    protected function setUp(): void
    {
        $this->render = (new TextRender())
            ->setStyle(
                (new TextRenderStyle())
                    ->setEmptyChar('.')
            );

        $this->frame = new Frame();
    }


    protected function addFigure(FigureInterface $figure): static
    {
        $this->frame->addFigure($figure);
        return $this;
    }


    protected function assertRender(string $expected)
    {
        $actual = $this->render->render($this->frame);

        $message = "Expected:\n" . $expected . "\n\nActual:\n" . $actual;
        $this->assertThat($actual, new RenderConstraint($expected), $message);
    }

}
