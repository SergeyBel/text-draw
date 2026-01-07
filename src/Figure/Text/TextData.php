<?php

declare(strict_types=1);

namespace TextDraw\Figure\Text;

use TextDraw\Plane\Point;

class TextData
{
    public function __construct(
        private Point $start,
        private string $text,
        private int $width,
        private int $paddingBefore,
        private int $paddingAfter
    ) {
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

    public function getPaddingBefore(): int
    {
        return $this->paddingBefore;
    }

    public function getPaddingAfter(): int
    {
        return $this->paddingAfter;
    }



}
