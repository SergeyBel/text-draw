<?php

namespace ConsoleDraw;

class Line implements FigureInterface
{
    /**
     * @see https://en.wikipedia.org/wiki/Bresenham%27s_line_algorithm
     */
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
        $points = [];
        $dx = $this->x1 - $this->x0;
        $dy = $this->y1 - $this->y0;
        $delta = 2 * $dy - $dx;
        $y = $this->y0;

        for ($x = $this->x0; $x <= $this->x1; $x++) {
            $points[] = new Point($x, $y, $this->char);
            if ($delta > 0) {
                $y++;
                $delta -= 2 * $dx;
            }
            $delta += 2 * $dy;
        }


        return $points;
    }



}
