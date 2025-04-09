<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Turtle;

use ConsoleDraw\Figure\BaseFigure;
use ConsoleDraw\Figure\Pixel\Pixel;
use ConsoleDraw\Figure\Text\Text;
use ConsoleDraw\Plane\Point;

class Turtle extends BaseFigure
{
    private Point $position;

    public function __construct()
    {
        $this->position = new Point(0, 0);
        parent::__construct();
    }

    public function moveRight(int $value = 1): Turtle
    {
        $this->position = $this->position->addX($value);
        return $this;
    }
    public function moveLeft(int $value = 1): Turtle
    {
        $this->position = $this->position->subX($value);
        return $this;
    }

    public function moveUp(int $value = 1): Turtle
    {
        $this->position = $this->position->subY($value);
        return $this;
    }

    public function moveDown(int $value = 1): Turtle
    {
        $this->position = $this->position->addY($value);
        return $this;
    }

    public function moveTo(Point $point): Turtle
    {
        $this->position = $point;
        return $this;
    }

    public function paintRight(string $symbol, int $value = 1): Turtle
    {
        for ($i = 0; $i < $value; $i++) {
            $this
                ->addFigure(new Pixel($this->position, $symbol))
                ->moveRight();
        }

        return $this;
    }

    public function paintLeft(string $symbol, int $value = 1): Turtle
    {
        for ($i = 0; $i < $value; $i++) {
            $this
                ->addFigure(new Pixel($this->position, $symbol))
                ->moveLeft();
        }

        return $this;
    }

    public function paintUp(string $symbol, int $value = 1): Turtle
    {
        for ($i = 0; $i < $value; $i++) {
            $this
                ->addFigure(new Pixel($this->position, $symbol))
                ->moveUp();
        }

        return $this;
    }

    public function paintDown(string $symbol, int $value = 1): Turtle
    {
        for ($i = 0; $i < $value; $i++) {
            $this
                ->addFigure(new Pixel($this->position, $symbol))
                ->moveDown();
        }

        return $this;
    }


    public function paintText(string $str): Turtle
    {
        $text = new Text($this->position, $str);
        $this->addFigure($text);
        return $this->moveRight(mb_strlen($str));
    }
}
