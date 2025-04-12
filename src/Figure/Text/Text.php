<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Text;

use ConsoleDraw\Figure\FigureInterface;
use ConsoleDraw\Figure\Pixel\Pixel;
use ConsoleDraw\Figure\Pixel\PixelMatrix;
use ConsoleDraw\Plane\Point;

class Text implements FigureInterface
{
    private TextStyle $style;
    public function __construct(
        private Point $start,
        private string $text,
    ) {
        $this->style = new TextStyle();
    }

    public function draw(): PixelMatrix
    {
        $pixels = new PixelMatrix();

        $start = clone $this->start;
        $length = $this->style->getWidth() ?? mb_strlen($this->text);
        $chars = str_split($this->text);

        for ($i = 0; $i < $length; $i++) {
            if ($i < count($chars)) {
                $char = $chars[$i];
            } else {
                $char = $this->style->getPaddingChar();
            }

            $pixels->setPixel(new Pixel($start, $char));
            $start = $start->addX(1);

        }

        return $pixels;
    }

    public function getStyle(): TextStyle
    {
        return $this->style;
    }

    public function setStyle(TextStyle $style): Text
    {
        $this->style = $style;
        return $this;
    }


}
