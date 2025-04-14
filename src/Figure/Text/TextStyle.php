<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Text;

class TextStyle
{
    private ?int $width = null;
    private string $paddingChar = ' ';
    private TextAlign $align = TextAlign::LEFT;

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

    public function alignRight(): self
    {
        $this->align = TextAlign::RIGHT;
        return $this;
    }

    public function alignCenter(): self
    {
        $this->align = TextAlign::CENTER;
        return $this;
    }

    public function getAlign(): TextAlign
    {
        return $this->align;
    }

    public function setAlign(TextAlign $align): TextStyle
    {
        $this->align = $align;
        return $this;
    }
}
