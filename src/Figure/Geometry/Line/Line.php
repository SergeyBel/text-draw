<?php

declare(strict_types=1);

namespace TextDraw\Figure\Geometry\Line;

use TextDraw\Figure\Base\BaseFigure;
use TextDraw\Figure\Pixel\Pixel;
use TextDraw\Plane\Point;
use TextDraw\Screen\Screen;

/**
 * @see https://en.wikipedia.org/wiki/Bresenham%27s_line_algorithm
 */
class Line extends BaseFigure
{
    private LineStyle $style;

    public function __construct(
        private Point $start,
        private Point $end,
    ) {
        $this->style = new LineStyle();
        parent::__construct();
    }

    public function draw(): Screen
    {
        $x0 = $this->start->getX();
        $x1 = $this->end->getX();
        $y0 = $this->start->getY();
        $y1 = $this->end->getY();
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

        if (!is_null($this->style->getStartChar())) {
            $pixels[0]->setChar($this->style->getStartChar());
        }

        if (!is_null($this->style->getFinishChar())) {
            $pixels[count($pixels) - 1]->setChar($this->style->getFinishChar());
        }

        return new Screen($pixels);
    }

    /**
     * @return array<Pixel>
     */
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

        $pixels = [];
        for ($x = $x0; $x <= $x1; $x++) {
            $pixels[] = new Pixel(new Point($x, $y), $symbol);
            if ($delta > 0) {
                $y += $yi;
                $delta = $delta + (2 * ($dy - $dx));
            } else {
                $delta += 2 * $dy;
            }

        }

        return $pixels;
    }

    /**
     * @return array<Pixel>
     */
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

        $pixels = [];
        for ($y = $y0; $y <= $y1; $y++) {
            $pixels[] = new Pixel(new Point($x, $y), $symbol);
            if ($delta > 0) {
                $x += $xi;
                $delta = $delta + (2 * ($dx - $dy));
            } else {
                $delta += 2 * $dx;
            }
        }

        return $pixels;
    }

    public function getStyle(): ?LineStyle
    {
        return $this->style;
    }

    public function setStyle(LineStyle $style): static
    {
        $this->style = $style;
        return $this;
    }
}
