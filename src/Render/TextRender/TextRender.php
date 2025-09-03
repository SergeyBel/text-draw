<?php

declare(strict_types=1);

namespace TextDraw\Render\TextRender;

use TextDraw\Common\Size;
use TextDraw\Screen\Screen;

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

    public function render(Screen $screen): string
    {
        $size = $this->size ?? $screen->getSize();
        $text = $this->getClearText($size);

        foreach ($screen->getPixels() as $pixel) {
            $text[$pixel->getPoint()->getY()][$pixel->getPoint()->getX()] = $pixel->getChar();
        }


        return implode("\n", array_map(fn ($row) => implode('', $row), $text));
    }


    public function setStyle(TextRenderStyle $style): static
    {
        $this->style = $style;
        return $this;
    }

    /**
     * @return string[][]
     */
    private function getClearText(Size $size): array
    {
        $text = [];
        for ($i = 0; $i < $size->getHeight(); $i++) {
            for ($j = 0; $j < $size->getWidth(); $j++) {
                $text[$i][$j] = $this->style->getEmptyChar();
            }
        }
        return $text;
    }

}
