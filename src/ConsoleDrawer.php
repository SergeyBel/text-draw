<?php

namespace ConsoleDraw;

class ConsoleDrawer
{
    private array $pixels;

    public function __construct(
        private int $width,
        private int $height,
    ) {
        $this->clear();
    }

    public function draw(): string
    {
        $text = '';
        for ($y = 0; $y < $this->height; $y++) {
            for ($x = 0; $x < $this->width; $x++) {
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
        $this->setPixels($figure->getPixels());

    }

    public function clear()
    {
        for ($y = 0; $y < $this->height; $y++) {
            for ($x = 0; $x < $this->width; $x++) {
                $this->pixels[$y][$x] = new Pixel($x, $y, ' ');
            }
        }
    }



    public function getWidth(): int
    {
        return $this->width;
    }


    public function getHeight(): int
    {
        return $this->height;
    }



}
