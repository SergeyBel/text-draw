<?php

declare(strict_types=1);

namespace TextDraw\Figure\Text;

class TextStyle
{
    private ?int $width = null;
    private string $paddingChar = ' ';
    private TextAlign $align = TextAlign::Left;


    public function getWidth(): ?int
    {
        return $this->width;
    }

    public function setWidth(?int $width): TextStyle
    {
        $this->width = $width;
        return $this;
    }

    public function getPaddingChar(): string
    {
        return $this->paddingChar;
    }

    public function setPaddingChar(string $paddingChar): TextStyle
    {
        $this->paddingChar = $paddingChar;
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
}
