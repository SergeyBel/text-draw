<?php

declare(strict_types=1);

namespace ConsoleDraw\Render\TextRender;

use ConsoleDraw\Figure\FigureInterface;
use ConsoleDraw\Figure\Pixel;
use ConsoleDraw\Plane\Point;
use ConsoleDraw\Plane\Size;
use ConsoleDraw\Render\RenderInterface;

class TextRender implements RenderInterface
{
    /**
     * @var Pixel[][]
     */
    private array $matrix;
    private TextRenderStyle $style;
    private Size $size;

    public function __construct(
        int $width,
        int $height,
    ) {
        $this->style = new TextRenderStyle();
        $this->size = new Size($width, $height);

        $this->clear();
    }
    public function render(): string
    {
        $lines = [];
        for ($y = 0; $y < $this->getSize()->getHeight(); $y++) {
            $line = '';
            for ($x = 0; $x < $this->getSize()->getWidth(); $x++) {
                $line .= $this->matrix[$y][$x]->getSymbol();
            }
            $lines[] = $line;

        }

        return implode("\n", $lines);
    }


    public function setPixel(Pixel $pixel): static
    {
        $this->matrix[$pixel->getPoint()->getY()][$pixel->getPoint()->getX()] = $pixel;
        return $this;
    }

    /**
     * @param array<Pixel> $pixels
     */
    public function setPixels(array $pixels): static
    {
        foreach ($pixels as $pixel) {
            $this->setPixel($pixel);
        }
        return $this;
    }

    public function addFigure(FigureInterface $figure): static
    {
        return $this->setPixels($figure->draw());
    }

    public function clear(): void
    {
        for ($y = 0; $y < $this->getSize()->getHeight(); $y++) {
            for ($x = 0; $x < $this->getSize()->getWidth(); $x++) {
                $this->matrix[$y][$x] = new Pixel(new Point($x, $y), $this->style->getEmptySymbol());
            }
        }

    }

    public function getSize(): Size
    {
        return $this->size;
    }

    public function setStyle(TextRenderStyle $style): TextRender
    {
        $this->style = $style;
        $this->clear();
        return $this;
    }




}
