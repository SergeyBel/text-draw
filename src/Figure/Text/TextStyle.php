<?php

declare(strict_types=1);

namespace TextDraw\Figure\Text;

use TextDraw\Common\Char;

class TextStyle
{
    private ?Char $paddingChar = null;


    public function getPaddingChar(): ?string
    {
        return $this->paddingChar?->getChar();
    }

    public function setPaddingChar(?string $paddingChar): TextStyle
    {
        $this->paddingChar = !is_null($paddingChar) ? new Char($paddingChar) : null;
        return $this;
    }
}
