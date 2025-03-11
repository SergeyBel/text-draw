<?php

namespace ConsoleDraw;

/**
 * @see https://en.wikipedia.org/wiki/Bresenham%27s_line_algorithm
 */
class Line implements FigureInterface
{
    public function __construct(
        private int $x0,
        private int $y0,
        private int $x1,
        private int $y1,
        private string $char = '*'
    ) {

    }

    public function getPoints(): array
    {
        $x0 = $this->x0;
        $x1 = $this->x1;
        $y0 = $this->y0;
        $y1 = $this->y1;

        if (abs($y1 - $y0) < abs($x1 - $x0)) {
            if ($x1 > $x0) {
                return $this->plotLineLow($x1, $y1, $x0, $y0);
            } else {
                return $this->plotLineLow($x0, $y0, $x1, $y1);
            }
        } else {
            if ($y0 > $y1) {
                return $this->plotLineHigh($x1, $y1, $x0, $y0);
            } else {
                return $this->plotLineHigh($x0, $y0, $x1, $y1);
            }
        }
    }

    private function plotLineLow(int $x0, int $y0, int $x1, int $y1): array
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
            $points[] = new Point($x, $y, $this->char);
            if ($delta > 0) {
                $y += $yi;
                $delta = $delta + (2 * ($dy - $dx));
            } else {
                $delta += 2 * $dy;
            }

        }

        return $points;
    }

    private function plotLineHigh(int $x0, int $y0, int $x1, int $y1): array
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
            $points[] = new Point($x, $y, $this->char);
            if ($delta > 0) {
                $x += $xi;
                $delta = $delta + (2 * ($dx - $dy));
            } else {
                $delta += 2 * $dx;
            }
        }

        return $points;
    }




}
