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

    public function getScreen(): Screen
    {
        $start = clone $this->start;

        if (mb_strlen($this->text) >= $this->width) {
            $text = mb_substr($this->text, 0, $this->width);
            $chars = mb_str_split($text);
            foreach ($chars as $char) {
                $this->addFigure(new Pixel($start, $char));
                $start = $start->addX(1);
            }

            return parent::getScreen();
        }

        $alignedText = $this->align();
        $startIndex = mb_strpos($alignedText, $this->text);
        $finishIndex = $startIndex + mb_strlen($this->text) - 1;

        $chars = mb_str_split($alignedText);

        foreach ($chars as $index => $char) {
            if ($index < $startIndex || $index > $finishIndex) {
                if (!is_null($this->style->getPaddingChar())) {
                    $this->addFigure(new Pixel($start, $this->style->getPaddingChar()));
                }
            } else {
                $this->addFigure(new Pixel($start, $char));
            }

            $start = $start->addX(1);
        }



        return parent::getScreen();
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

    private function align(): string
    {
        $mode = match ($this->style->getAlign()) {
            HorizontalAlign::Left => STR_PAD_RIGHT,
            HorizontalAlign::Right => STR_PAD_LEFT,
            HorizontalAlign::Center => STR_PAD_BOTH,
        };

        return mb_str_pad($this->text, $this->width, ' ', $mode);
    }
}
