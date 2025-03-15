<?php

namespace ConsoleDraw;

use ConsoleDraw\Figure\FigureInterface;
use ConsoleDraw\Figure\FrameFigure;
use ConsoleDraw\Figure\Pixel;
use ConsoleDraw\Plane\Point;
use ConsoleDraw\Plane\Size;

class ConsoleRender
{
    private array $pixels;
    private Size $size;

    public function __construct(
        int $width,
        $height,
    ) {
        $this->size = new Size($width, $height);
        $this->clear();
    }

    public function render(): string
    {
        $text = '';
        for ($y = 0; $y < $this->getSize()->getHeight(); $y++) {
            for ($x = 0; $x < $this->getSize()->getHeight(); $x++) {
                $text .= $this->pixels[$y][$x]->getChar();
            }
            $text .= "\n";
        }

        return $text;
    }

    public function setPixel(Pixel $point)
    {
        $this->pixels[$point->getY()][$point->getX()] = $point;
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
                $this->pixels[$y][$x] = new Pixel($x, $y, ' ');
            }
        }
    }

    public function getSize(): Size
    {
        return $this->size;
    }

    public function setSize(Size $size): ConsoleRender
    {
        $this->size = $size;
        return $this;
    }







}
