<?php

namespace ConsoleDraw;

use ConsoleDraw\Figure\FigureInterface;
use ConsoleDraw\Figure\FrameFigure;
use ConsoleDraw\Figure\Pixel;
use ConsoleDraw\Plane\Point;
use ConsoleDraw\Plane\Size;

class Console
{

    private array $pixels;
    private Size $size;
    private ConsoleStyle $style;

    public function __construct(
        int $width,
        int $height,
    ) {
        $this->size = new Size($width, $height);
        $this->style = new ConsoleStyle();
        $this->clear();
    }

    public function render(): string
    {
        $text = '';
        for ($y = 0; $y < $this->getSize()->getHeight(); $y++) {
            for ($x = 0; $x < $this->getSize()->getWidth(); $x++) {
                $text .= $this->pixels[$y][$x]->getSymbol();
            }
            $text .= "\n";
        }

        return $text;
    }

    public function setPixel(Pixel $pixel)
    {
        $this->pixels[$pixel->getPoint()->getY()][$pixel->getPoint()->getX()] = $pixel;
    }

    public function setPixels(array $pixels)
    {
        foreach ($pixels as $point) {
            $this->setPixel($point);
        }
    }

    public function addFigure(FigureInterface $figure)
    {
        if ($figure instanceof FrameFigure)
        {
            if (is_null($figure->getSize())) {
                $figure->setSize($this->getSize());
            }

            if (is_null($figure->getLeftUpperCorner())) {
                $figure->setLeftUpperCorner(new Point(0, 0));
            }

        }
        $this->setPixels($figure->draw());

    }

    public function clear()
    {
        for ($y = 0; $y < $this->getSize()->getHeight(); $y++) {
            for ($x = 0; $x < $this->getSize()->getWidth(); $x++) {
                $this->pixels[$y][$x] = new Pixel(new Point($x, $y), $this->style->getEmptySymbol());
            }
        }
    }

    public function getSize(): Size
    {
        return $this->size;
    }

    public function setSize(Size $size): Console
    {
        $this->size = $size;
        return $this;
    }

    public function getStyle(): ConsoleStyle
    {
        return $this->style;
    }

    public function setStyle(ConsoleStyle $style): Console
    {
        $this->style = $style;
        $this->clear();
        return $this;
    }









}
