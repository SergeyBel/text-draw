<?php

declare(strict_types=1);

namespace ConsoleDraw\Render\TextRender;

use ConsoleDraw\Common\Size;
use ConsoleDraw\Figure\Base\FigureInterface;
use ConsoleDraw\Figure\Pixel\PixelMatrix;
use ConsoleDraw\Render\RenderInterface;

class TextRender implements RenderInterface
{
    private PixelMatrix $matrix;
    private TextRenderStyle $style;
    private ?Size $size = null;

    public function __construct(
        ?Size $size = null
    ) {
        $this->style = new TextRenderStyle();
        $this->size = $size;
        $this->matrix = new PixelMatrix();

        $this->clear();
    }

    public function render(): string
    {
        if (is_null($this->size)) {
            $this->size = $this->matrix->getMinSize();
        }

        $lines = [];
        for ($y = 0; $y < $this->size->getHeight(); $y++) {
            $line = '';
            for ($x = 0; $x < $this->size->getWidth(); $x++) {
                $line .= $this->matrix->hasPixel($x, $y) ? $this->matrix->getPixel($x, $y)->getChar() : $this->style->getEmptyChar();
            }
            $lines[] = $line;

        }

        return implode("\n", $lines);
    }



    public function addFigure(FigureInterface $figure): static
    {
        $this->matrix->merge($figure->draw());
        return $this;
    }

    private function clear(): void
    {
        $this->matrix->clear();
    }

    public function setStyle(TextRenderStyle $style): static
    {
        $this->style = $style;
        $this->clear();
        return $this;
    }
}
