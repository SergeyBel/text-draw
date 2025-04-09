<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Text;

use ConsoleDraw\Figure\FigureInterface;
use ConsoleDraw\Figure\Pixel\Pixel;
use ConsoleDraw\Figure\Pixel\PixelMatrix;
use ConsoleDraw\Plane\Point;

class Text implements FigureInterface
{
    public function __construct(
        private Point $start,
        private string $str
    ) {
    }

    public function draw(): PixelMatrix
    {
        $chars = str_split($this->str);

        $pixels = new PixelMatrix();
        $length = 0;

        foreach ($chars as $char) {
            $pixels->setPixel(new Pixel($this->start->addX($length), $char));
            $length++;
        }

        return $pixels;
    }
}
