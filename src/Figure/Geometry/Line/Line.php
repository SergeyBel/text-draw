<?php

namespace ConsoleDraw\Figure\Geometry\Line;

use ConsoleDraw\Figure\FigureInterface;
use ConsoleDraw\Figure\Pixel;

/**
 * @see https://en.wikipedia.org/wiki/Bresenham%27s_line_algorithm
 */
class Line implements FigureInterface
{
    private ?LineStyle $style = null;

    public function __construct(
        private int $x0,
        private int $y0,
        private int $x1,
        private int $y1,
    ) {
        if (is_null($this->style)) {
            $this->style = new LineStyle();
        }

    }

    public function draw(): array
    {
        $x0 = $this->x0;
        $x1 = $this->x1;
        $y0 = $this->y0;
        $y1 = $this->y1;
        $symbol = $this->style->getSymbol();

        if (abs($y1 - $y0) < abs($x1 - $x0)) {
            if ($x0 > $x1) {
                $pixels = $this->plotLineLow($x1, $y1, $x0, $y0, $symbol);
            } else {
                $pixels = $this->plotLineLow($x0, $y0, $x1, $y1, $symbol);
            }
        } else {
            if ($y0 > $y1) {
                $pixels = $this->plotLineHigh($x1, $y1, $x0, $y0, $symbol);
            } else {
                $pixels = $this->plotLineHigh($x0, $y0, $x1, $y1, $symbol);
            }
        }

        if ($this->style->excludeStart()) {
            array_shift($pixels);
        }

        if ($this->style->excludeFinish()) {
            array_pop($pixels);
        }

        return $pixels;
    }

    private function plotLineLow(int $x0, int $y0, int $x1, int $y1, string $symbol): array
    {
        $dx = $x1 - $x0;
        $dy = $y1 - $y0;
        $yi = 1;

        if ($dy < 0) {
            $yi = -1;
            $dy = -$dy;
        }
        $delta = 2 * $dy - $dx;
        $y = $y0;

        $points = [];
        for ($x = $x0; $x <= $x1; $x++) {
            $points[] = new Pixel($x, $y, $symbol);
            if ($delta > 0) {
                $y += $yi;
                $delta = $delta + (2 * ($dy - $dx));
            } else {
                $delta += 2 * $dy;
            }

        }

        return $points;
    }

    private function plotLineHigh(int $x0, int $y0, int $x1, int $y1, string $symbol): array
    {
        $dx = $x1 - $x0;
        $dy = $y1 - $y0;
        $xi = 1;

        if ($dx < 0) {
            $xi = -1;
            $dx = -$dx;
        }
        $delta = 2 * $dx - $dy;
        $x = $x0;

        $points = [];
        for ($y = $y0; $y <= $y1; $y++) {
            $points[] = new Pixel($x, $y, $symbol);
            if ($delta > 0) {
                $x += $xi;
                $delta = $delta + (2 * ($dx - $dy));
            } else {
                $delta += 2 * $dx;
            }
        }

        return $points;
    }

    public function getStyle(): ?LineStyle
    {
        return $this->style;
    }

    public function setStyle(?LineStyle $style): Line
    {
        $this->style = $style;
        return $this;
    }






}
