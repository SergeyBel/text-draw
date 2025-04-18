<?php

declare(strict_types=1);

namespace ConsoleDraw\Render\ImageRender;

class TextLine
{
    public function __construct(
        private string $text,
        private int $width,
        private int $height
    ) {
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }




}
