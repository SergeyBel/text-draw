<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure;

use PHPUnit\Framework\TestCase;
use TextDraw\Figure\Base\FigureInterface;
use TextDraw\Render\Scene;
use TextDraw\Render\TextRender\TextRender;
use TextDraw\Render\TextRender\TextRenderStyle;
use TextDraw\Tests\RenderConstraint;

class FigureTestCase extends TestCase
{
    protected TextRender $render;

    protected Scene $frame;

    protected function setUp(): void
    {
        $this->render = new TextRender()
            ->setStyle(
                new TextRenderStyle()
                    ->setEmptyChar('.')
            );

        $this->frame = new Scene();
    }


    protected function addFigure(FigureInterface $figure): static
    {
        $this->frame->addFigure($figure);
        return $this;
    }


    protected function assertRender(string $expected)
    {
        $actual = $this->render->render($this->frame);

        $message = sprintf(
            "Expected(length=%d):\n%s\n\nActual(length=%d):\n%s\n",
            mb_strlen($expected),
            $expected,
            mb_strlen($actual),
            $actual
        );
        $this->assertThat($actual, new RenderConstraint($expected), $message);
    }

}
