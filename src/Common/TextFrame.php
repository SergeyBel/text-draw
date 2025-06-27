<?php

declare(strict_types=1);

namespace TextDraw\Common;

class TextFrame
{
    private int $width;

    public function __construct(
        private string $text,
        ?int $width = null,
        private TextAlign $align = TextAlign::Left,
        private string $paddingChar = ' ',
    ) {
        $this->setWidth($width);
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

    public function setText(string $text): static
    {
        $this->text = $text;
        return $this;
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
        $this->width = $width;
        return $this;
    }

    public function getAlign(): TextAlign
    {
        return $this->align;
    }

    public function setAlign(TextAlign $align): static
    {
        $this->align = $align;
        return $this;
    }

    public function getPaddingChar(): string
    {
        return $this->paddingChar;
    }

    public function setPaddingChar(string $paddingChar): static
    {
        $this->paddingChar = $paddingChar;
        return $this;
    }

    private function align(): string
    {
        $mode = match ($this->align) {
            TextAlign::Left => STR_PAD_RIGHT,
            TextAlign::Right => STR_PAD_LEFT,
            TextAlign::Center => STR_PAD_BOTH,
        };

        return mb_str_pad($this->text, $this->width, $this->paddingChar, $mode);
    }
}
