<?php

declare(strict_types=1);

namespace TextDraw\Render\TextRender;

use TextDraw\Common\Size;
use TextDraw\Frame\Frame;

class TextRender
{
    private TextRenderStyle $style;
    private ?Size $size;

    public function __construct(
        ?Size $size = null
    ) {
        $this->style = new TextRenderStyle();
        $this->size = $size;
    }

    public function render(Frame $frame): string
    {
        $matrix = $frame->draw();

        if (is_null($this->size)) {
            $this->size = $matrix->getMinHull();
        }

        $lines = [];
        for ($y = 0; $y < $this->size->getHeight(); $y++) {
            $line = '';
            for ($x = 0; $x < $this->size->getWidth(); $x++) {
                $line .= $matrix->hasPixel($x, $y) ? $matrix->getPixel($x, $y)->getChar() : $this->style->getEmptyChar();
            }
            $lines[] = $line;

        }

        return implode("\n", $lines);
    }


    public function setStyle(TextRenderStyle $style): static
    {
        $this->style = $style;
        return $this;
    }
}
