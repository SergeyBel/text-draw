<?php

declare(strict_types=1);

namespace ConsoleDraw\Render\TextRender;

class TextRenderStyle
{
    private string $emptySymbol = ' ';

    public function getEmptySymbol(): string
    {
        return $this->emptySymbol;
    }

    public function setEmptySymbol(string $emptySymbol): TextRenderStyle
    {
        $this->emptySymbol = $emptySymbol;
        return $this;
    }
}
