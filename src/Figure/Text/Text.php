<?php

namespace ConsoleDraw\Figure\Text;

use ConsoleDraw\Figure\FigureInterface;
use ConsoleDraw\Figure\Pixel;
use ConsoleDraw\Plane\Point;

class Text implements FigureInterface
{
    public function __construct(
        Point $start,
        private string $str
    ) {
    }

    public function draw(): array
    {
        $chars = str_split($this->str);

        $pixels = [];
        $x = $this->start->getX();
        foreach ($chars as $char) {
            $pixels[] = new Pixel($x, $this->start->getY(), $char);
            $x++;
        }

        return $pixels;
    }
}
