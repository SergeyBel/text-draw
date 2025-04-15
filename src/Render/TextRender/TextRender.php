<?php

declare(strict_types=1);

namespace ConsoleDraw\Render\TextRender;

use ConsoleDraw\Figure\FigureInterface;
use ConsoleDraw\Figure\Pixel\Pixel;
use ConsoleDraw\Figure\Pixel\PixelMatrix;
use ConsoleDraw\Plane\Point;
use ConsoleDraw\Plane\Size;
use ConsoleDraw\Render\RenderInterface;

class TextRender implements RenderInterface
{
    private PixelMatrix $matrix;
    private TextRenderStyle $style;
    private Size $size;

    public function __construct(
        int $width,
        int $height,
    ) {
        $this->style = new TextRenderStyle();
        $this->size = new Size($width, $height);
        $this->matrix = new PixelMatrix();

        $this->clear();
    }
    public function render(): string
    {
        $lines = [];
        for ($y = 0; $y < $this->getSize()->getHeight(); $y++) {
            $line = '';
            for ($x = 0; $x < $this->getSize()->getWidth(); $x++) {
                $line .= $this->matrix->getPixel($x, $y)->getChar();
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

    public function clear(): void
    {
        $this->matrix->clear();
        for ($y = 0; $y < $this->getSize()->getHeight(); $y++) {
            for ($x = 0; $x < $this->getSize()->getWidth(); $x++) {
                $this->matrix->setPixel(new Pixel(new Point($x, $y), $this->style->getEmptySymbol()));
            }
        }

    }

    public function getSize(): Size
    {
        return $this->size;
    }

    public function setStyle(TextRenderStyle $style): static
    {
        $this->style = $style;
        $this->clear();
        return $this;
    }




}
