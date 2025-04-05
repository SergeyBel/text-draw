<?php

declare(strict_types=1);

namespace ConsoleDraw\Render\TextRender;

use ConsoleDraw\Figure\FigureInterface;
use ConsoleDraw\Figure\FrameFigure;
use ConsoleDraw\Figure\Pixel;
use ConsoleDraw\Plane\Point;
use ConsoleDraw\Plane\Size;
use ConsoleDraw\Render\BaseRender;

class TextRender extends BaseRender
{
    private TextRenderStyle $style;

    public function __construct(
        int $width,
        int $height,
    ) {
        $this->style = new TextRenderStyle();
        parent::__construct(new Size($width, $height));
    }

    public function render(): string
    {
        $matrix = $this->getEmptyMatrix();
        foreach ($this->pixels as $pixel) {
            $matrix[$pixel->getPoint()->getY()][$pixel->getPoint()->getX()] = $pixel;
        }

        $lines = [];
        for ($y = 0; $y < $this->getSize()->getHeight(); $y++) {
            $line = '';
            for ($x = 0; $x < $this->getSize()->getWidth(); $x++) {
                $line .= $matrix[$y][$x]->getSymbol();
            }
            $lines[] = $line;

        }

        return implode("\n", $lines);
    }


    /**
     * @return Pixel[][]
     */
    public function getEmptyMatrix(): array
    {
        $matrix = [];
        for ($y = 0; $y < $this->getSize()->getHeight(); $y++) {
            for ($x = 0; $x < $this->getSize()->getWidth(); $x++) {
                $matrix[$y][$x] = new Pixel(new Point($x, $y), $this->style->getEmptySymbol());
            }
        }
        return $matrix;
    }

    public function setPixel(Pixel $pixel): static
    {
        $this->pixels[] = $pixel;
        return $this;
    }

    /**
     * @param array<Pixel> $pixels
     */
    public function setPixels(array $pixels): static
    {
        foreach ($pixels as $point) {
            $this->setPixel($point);
        }
        return $this;
    }

    public function addFigure(FigureInterface $figure): static
    {
        if ($figure instanceof FrameFigure) {
            if (is_null($figure->getSize())) {
                $figure->setSize($this->size);
            }

            if (is_null($figure->getLeftUpperCorner())) {
                $figure->setLeftUpperCorner(new Point(0, 0));
            }

        }
        return $this->setPixels($figure->draw());
    }

    public function getSize(): Size
    {
        return $this->size;
    }

    public function setStyle(TextRenderStyle $style): TextRender
    {
        $this->style = $style;
        return $this;
    }
}
