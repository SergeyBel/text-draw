<?php

namespace ConsoleDraw\Figure\Turtle;

use ConsoleDraw\Figure\BaseFigure;
use ConsoleDraw\Figure\Pixel;
use ConsoleDraw\Figure\Text\Text;
use ConsoleDraw\Plane\Point;

class Turtle extends BaseFigure
{
    private Point $position;

    public function __construct()
    {
        $this->position = new Point(0, 0);
    }

    public function moveRight(int $value): Turtle
    {
        $this->position = $this->position->addX($value);
        return $this;
    }
    public function moveLeft(int $value): Turtle
    {
        $this->position = $this->position->subX($value);
        return $this;
    }

    public function moveUp(int $value): Turtle
    {
        $this->position = $this->position->subY($value);
        return $this;
    }

    public function moveDown(int $value): Turtle
    {
        $this->position = $this->position->addY($value);
        return $this;
    }

    public function moveTo(int $x, int $y): Turtle
    {
        $this->position = new Point($x, $y);
        return $this;
    }

    public function setSymbol(string $symbol): Turtle
    {
        $this->addFigure(new Pixel($this->position, $symbol));
        return $this->moveRight(1);
    }

    public function setText(string $str): Turtle
    {
        $text = new Text($this->position, $str);
        $this->addFigure($text);
        return $this->moveRight(mb_strlen($str));
    }
}
