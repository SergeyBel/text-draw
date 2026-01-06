<?php

declare(strict_types=1);

namespace TextDraw\Figure\Text;

use TextDraw\Common\HorizontalAlign;
use TextDraw\Figure\Base\BaseFigure;
use TextDraw\Figure\Pixel\Pixel;
use TextDraw\Plane\Point;
use TextDraw\Screen\Screen;

class Text extends BaseFigure
{
    private TextStyle $style;
    private int $width;

    public function __construct(
        private Point $start,
        private string $text,
        ?int $width = null,
    ) {
        $this->style = new TextStyle();
        if (is_null($width)) {
            $this->width = mb_strlen($this->text);
        } else {
            $this->width = $width;
        }
        parent::__construct();
    }

    public function draw(): Screen
    {
        $start = clone $this->start;

        $length = mb_strlen($this->text);
        if ($this->style->getAlign() === HorizontalAlign::Left) {
            $paddingBefore = 0;
            $paddingAfter = max(0, $this->width - $length);
        } elseif ($this->style->getAlign() === HorizontalAlign::Right) {
            $paddingBefore = max(0, $this->width - $length);
            $paddingAfter = 0;
        } elseif ($this->style->getAlign() === HorizontalAlign::Center) {
            $paddingAfter = max(0, intdiv($this->width, 2) - intdiv($length, 2));
            $paddingBefore = max(0, $this->width - $length - $paddingAfter);
        }


        for ($i = 0; $i < $paddingBefore; $i++) {
            if (!is_null($this->style->getPaddingChar())) {
                $this->addFigure(new Pixel($start, $this->style->getPaddingChar()));
            }

            $start = $start->addX(1);
        }

        $chars = mb_str_split($this->text);

        for ($i = 0; $i < $this->width - $paddingBefore - $paddingAfter; $i++) {
            $this->addFigure(new Pixel($start, $chars[$i]));

            $start = $start->addX(1);
        }

        for ($i = 0; $i < $paddingAfter; $i++) {
            if (!is_null($this->style->getPaddingChar())) {
                $this->addFigure(new Pixel($start, $this->style->getPaddingChar()));
            }

            $start = $start->addX(1);
        }

        return parent::draw();
    }

    public function getStyle(): TextStyle
    {
        return $this->style;
    }

    public function getStart(): Point
    {
        return $this->start;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function setStyle(TextStyle $style): static
    {
        $this->style = $style;
        return $this;
    }
}
