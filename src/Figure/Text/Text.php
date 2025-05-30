<?php

declare(strict_types=1);

namespace TextDraw\Figure\Text;

use TextDraw\Figure\Base\FigureInterface;
use TextDraw\Figure\Pixel\Pixel;
use TextDraw\Figure\Pixel\PixelMatrix;
use TextDraw\Plane\Point;

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

        $textLength = mb_strlen($this->text);
        $width = $this->style->getWidth();
        $text = $this->text;

        if (!is_null($width)) {
            if ($width > $textLength) {
                $text = $this->align($width);
            } else {
                $text = mb_substr($this->text, 0, $width);
            }
        }


        $chars = mb_str_split($text);

        foreach ($chars as $char) {
            $pixels->setPixel(new Pixel($start, $char));
            $start = $start->addX(1);
        }

        return $pixels;
    }

    public function getStyle(): TextStyle
    {
        return $this->style;
    }

    public function setStyle(TextStyle $style): static
    {
        $this->style = $style;
        return $this;
    }

    private function align(int $length): string
    {
        $mode = match ($this->style->getAlign()) {
            TextAlign::Left => STR_PAD_RIGHT,
            TextAlign::Right => STR_PAD_LEFT,
            TextAlign::Center => STR_PAD_BOTH,
        };

        return mb_str_pad($this->text, $length, $this->style->getPaddingChar(), $mode);
    }


}
