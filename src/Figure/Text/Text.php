<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Text;

use ConsoleDraw\Figure\FigureInterface;
use ConsoleDraw\Figure\Pixel;
use ConsoleDraw\Plane\Point;

class Text implements FigureInterface
{
    public function __construct(
        private Point $start,
        private string $str
    ) {
    }

    public function draw(): array
    {
        $chars = str_split($this->str);

        $pixels = [];
        $length = 0;

        foreach ($chars as $char) {
            $pixels[] = new Pixel($this->start->addX($length), $char);
            $length++;
        }

        return $pixels;
    }
}
