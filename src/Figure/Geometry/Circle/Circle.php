<?php

namespace ConsoleDraw\Figure\Geometry\Circle;

use ConsoleDraw\Figure\FigureInterface;
use ConsoleDraw\Pixel;

class Circle implements FigureInterface
{
    public function __construct(
        private int $x,
        private int $y,
        private int $radius,
        private string $char
    ) {
    }

    public function draw(): array
    {
        $points = [];

        $x1 = $this->x;
        $y1 = $this->y;

        $x = 0;
        $y = $this->radius;
        $delta = 1 - 2 * $this->radius;

        while ($y >= $x) {
            $points[] = new Pixel($x1 + $x, $y1 + $y, $this->char);
            $points[] = new Pixel($x1 + $x, $y1 - $y, $this->char);
            $points[] = new Pixel($x1 - $x, $y1 + $y, $this->char);
            $points[] = new Pixel($x1 - $x, $y1 - $y, $this->char);
            $points[] = new Pixel($x1 + $y, $y1 + $x, $this->char);
            $points[] = new Pixel($x1 + $y, $y1 - $x, $this->char);
            $points[] = new Pixel($x1 - $y, $y1 + $x, $this->char);
            $points[] = new Pixel($x1 - $y, $y1 - $x, $this->char);
            $error = 2 * ($delta + $y) - 1;

            if ($delta < 0 && $error <= 0) {
                $delta += 2 * ++$x + 1;
                continue;
            }

            if ($delta > 0 && $error > 0) {
                $delta -= 2 * --$y + 1;
                continue;
            }
            $delta += 2 * (++$x - --$y);
        }
        return $points;

    }


}
