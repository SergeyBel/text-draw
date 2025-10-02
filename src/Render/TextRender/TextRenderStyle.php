<?php

declare(strict_types=1);

namespace TextDraw\Render\TextRender;

use TextDraw\Common\Char;

class TextRenderStyle
{
    private Char $emptyChar;

    public function __construct()
    {
        $this->emptyChar = new Char(' ');
    }

    public function getEmptyChar(): string
    {
        return $this->emptyChar->getChar();
    }

    public function setEmptyChar(string $emptyChar): static
    {
        $this->emptyChar = new Char($emptyChar);
        return $this;
    }
}
