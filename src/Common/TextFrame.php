<?php

declare(strict_types=1);

namespace TextDraw\Common;

class TextFrame
{
    private int $width;

    public function __construct(
        private string $text,
        ?int $width = null,
        private HorizontalAlign $align = HorizontalAlign::Left,
        private string $paddingChar = ' ',
    ) {
        if (is_null($width)) {
            $width = mb_strlen($this->text);
        }
        $this->width = $width;
    }

    public function getText(): string
    {
        $textLength = mb_strlen($this->text);

        if ($this->width > $textLength) {
            return $this->align();
        } else {
            return mb_substr($this->text, 0, $this->width);
        }
    }


    public function getWidth(): int
    {
        return $this->width;
    }

    public function setWidth(?int $width): static
    {
        if (is_null($width)) {
            $width = mb_strlen($this->text);
        }
        $that = clone $this;

        $that->width = $width;
        return $that;
    }

    public function getAlign(): HorizontalAlign
    {
        return $this->align;
    }

    public function setAlign(HorizontalAlign $align): static
    {
        $that = clone $this;

        $that->align = $align;
        return $that;
    }

    public function getPaddingChar(): string
    {
        return $this->paddingChar;
    }

    public function setPaddingChar(string $paddingChar): static
    {
        $that = clone $this;

        $that->paddingChar = $paddingChar;
        return $that;
    }

    private function align(): string
    {
        $mode = match ($this->align) {
            HorizontalAlign::Left => STR_PAD_RIGHT,
            HorizontalAlign::Right => STR_PAD_LEFT,
            HorizontalAlign::Center => STR_PAD_BOTH,
        };

        return mb_str_pad($this->text, $this->width, $this->paddingChar, $mode);
    }
}
