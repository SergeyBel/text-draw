<?php

declare(strict_types=1);

namespace TextDraw\Figure\Text;

use TextDraw\Common\HorizontalAlign;
use TextDraw\Common\Char;

class TextStyle
{
    private ?Char $paddingChar = null;
    private HorizontalAlign $align = HorizontalAlign::Left;


    public function getPaddingChar(): ?string
    {
        return $this->paddingChar?->getChar();
    }

    public function setPaddingChar(?string $paddingChar): TextStyle
    {
        $this->paddingChar = !is_null($paddingChar) ? new Char($paddingChar) : null;
        return $this;
    }

    public function getAlign(): HorizontalAlign
    {
        return $this->align;
    }

    public function setAlign(HorizontalAlign $align): static
    {
        $this->align = $align;
        return $this;
    }
}
