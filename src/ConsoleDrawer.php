<?php

namespace ConsoleDraw;

class ConsoleDrawer
{
    private array $points;

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
                $text .= $this->points[$y][$x]->getChar();
            }
            $text .= "\n";
        }

        return $text;
    }

    public function setPoint(Point $point)
    {
        $this->points[$point->getY()][$point->getX()] = $point;
    }

    public function setPoints(array $points)
    {
        foreach ($points as $point) {
            $this->setPoint($point);
        }
    }

    public function addFigure(FigureInterface $figure)
    {
        $this->setPoints($figure->getPoints());

    }

    public function clear()
    {
        for ($y = 0; $y < $this->height; $y++) {
            for ($x = 0; $x < $this->width; $x++) {
                $this->points[$y][$x] = new Point($x, $y);
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
