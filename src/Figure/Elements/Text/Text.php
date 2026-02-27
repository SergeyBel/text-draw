<?php

declare(strict_types=1);

namespace TextDraw\Figure\Elements\Text;

use TextDraw\Common\HorizontalAlign;
use TextDraw\Plane\Point;

class Text
{
    private int $width;

    public function __construct(
        private Point $start,
        private string $text,
        ?int $width = null,
        private HorizontalAlign $align = HorizontalAlign::Left,
    ) {
        $this->width = is_null($width) ? mb_strlen($this->text) : $width;
    }


    public function getStart(): Point
    {
        return $this->start;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getAlign(): HorizontalAlign
    {
        return $this->align;
    }




}
