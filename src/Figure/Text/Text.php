<?php

declare(strict_types=1);

namespace TextDraw\Figure\Text;

use TextDraw\Common\HorizontalAlign;
use TextDraw\Figure\Base\FigureInterface;
use TextDraw\Plane\Point;
use TextDraw\Screen\Screen;

class Text implements FigureInterface
{
    private TextStyle $style;

    public function __construct(
        private Point $start,
        private string $text,
        private ?int $width = null,
        private HorizontalAlign $align = HorizontalAlign::Left,
    ) {
        $this->style = new TextStyle();
    }

    public function draw(): Screen
    {
        $width = is_null($this->width) ? mb_strlen($this->text) : $this->width;

        $length = mb_strlen($this->text);
        if ($this->align === HorizontalAlign::Left) {
            $paddingBefore = 0;
            $paddingAfter = max(0, $width - $length);
        } elseif ($this->align === HorizontalAlign::Right) {
            $paddingBefore = max(0, $width - $length);
            $paddingAfter = 0;
        } elseif ($this->align === HorizontalAlign::Center) {
            $paddingAfter = max(0, intdiv($width, 2) - intdiv($length, 2));
            $paddingBefore = max(0, $width - $length - $paddingAfter);
        }

        return new TextDrawer()->draw(
            new TextData(
                $this->start,
                $this->text,
                $width,
                $paddingBefore,
                $paddingAfter
            ),
            $this->style
        );
    }

    public function getStyle(): TextStyle
    {
        return $this->style;
    }

    public function setStyle(TextStyle $style): static
    {
        $that = clone $this;
        $that->style = $style;
        return $that;
    }
}
