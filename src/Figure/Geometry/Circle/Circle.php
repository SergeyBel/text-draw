<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Geometry\Circle;

use ConsoleDraw\Figure\FigureInterface;
use ConsoleDraw\Figure\Pixel\Pixel;
use ConsoleDraw\Figure\Pixel\PixelMatrix;
use ConsoleDraw\Plane\Point;

class Circle implements FigureInterface
{
    private CircleStyle $style;

    public function __construct(
        private Point $center,
        private int $radius,
    ) {
        $this->style = new CircleStyle();
    }

    public function draw(): PixelMatrix
    {
        $points = [];

        $x1 = $this->center->getX();
        $y1 = $this->center->getY();
        $symbol = $this->style->getChar();

        $x = 0;
        $y = $this->radius;
        $delta = 1 - 2 * $this->radius;

        while ($y >= $x) {
            $points[] = new Pixel(new Point($x1 + $x, $y1 + $y), $symbol);
            $points[] = new Pixel(new Point($x1 + $x, $y1 - $y), $symbol);
            $points[] = new Pixel(new Point($x1 - $x, $y1 + $y), $symbol);
            $points[] = new Pixel(new Point($x1 - $x, $y1 - $y), $symbol);
            $points[] = new Pixel(new Point($x1 + $y, $y1 + $x), $symbol);
            $points[] = new Pixel(new Point($x1 + $y, $y1 - $x), $symbol);
            $points[] = new Pixel(new Point($x1 - $y, $y1 + $x), $symbol);
            $points[] = new Pixel(new Point($x1 - $y, $y1 - $x), $symbol);
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
        return new PixelMatrix($points);

    }
}
