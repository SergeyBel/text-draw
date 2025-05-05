<?php

declare(strict_types=1);

namespace TextDraw\Render\TextRender;

class TextRenderStyle
{
    private string $emptyChar = ' ';

    public function getEmptyChar(): string
    {
        return $this->emptyChar;
    }

    public function setEmptyChar(string $emptyChar): static
    {
        $this->emptyChar = $emptyChar;
        return $this;
    }
}
