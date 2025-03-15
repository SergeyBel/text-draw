<?php

namespace ConsoleDraw\Plane;

class Point
{

    public function __construct(
        private int $x,
        private int $y)
    {

    }

    public function getX(): int
    {
        return $this->x;
    }

    public function setX(int $x): Point
    {
        $this->x = $x;
        return $this;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function setY(int $y): Point
    {
        $this->y = $y;
        return $this;
    }



}