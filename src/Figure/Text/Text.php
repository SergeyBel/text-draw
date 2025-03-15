<?php

namespace ConsoleDraw\Figure\Text;

use ConsoleDraw\Figure\FigureInterface;
use ConsoleDraw\Figure\Pixel;

class Text implements FigureInterface
{
    public function __construct(
        private int $x,
        private int $y,
        private string $str
    ) {
    }

    public function draw(): array
    {
        $chars = str_split($this->str);

        $pixels = [];
        $x = $this->x;
        foreach ($chars as $char) {
            $pixels[] = new Pixel($x, $this->y, $char);
            $x++;
        }

        return $pixels;
    }
}
