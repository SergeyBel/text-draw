<?php

declare(strict_types=1);

namespace TextDraw\Tests\Figure;

use PHPUnit\Framework\TestCase;
use TextDraw\Render\TextRender\TextRender;
use TextDraw\Render\TextRender\TextRenderStyle;
use TextDraw\Screen\Screen;
use TextDraw\Tests\RenderConstraint;

class FigureTestCase extends TestCase
{
    protected function assertRender(string $expected, Screen $screen): void
    {
        $actual = $this->getRender()->render($screen);

        $message = sprintf(
            "Expected(length=%d):\n%s\n\nActual(length=%d):\n%s\n",
            mb_strlen($expected),
            $this->format($expected),
            mb_strlen($actual),
            $this->format($actual)
        );
        $this->assertThat($actual, new RenderConstraint($expected), $message);
    }

    private function format(string $str): string
    {
        $lines = explode("\n", $str);
        foreach ($lines as $key => $line) {
            $lines[$key] = '"' . ($line) . '\\n"';
        }

        return implode("\n", $lines);
    }

    private function getRender(): TextRender
    {
        return  new TextRender()
            ->setStyle(
                new TextRenderStyle()
                    ->setEmptyChar('.')
            );
    }

}
