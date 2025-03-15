<?php

namespace ConsoleDraw\Plane;

class Point
{
    public function __construct(
        private int $x,
        private int $y
    )
    {

    }

    public function addWidth(int $value): Point
    {
        $that = clone $this;
        $that->x += $value - 1;
        return $that;
    }

    public function addHeight(int $value): Point
    {
        $that = clone $this;
        $that->y += $value - 1;
        return $that;
    }

    public function addY(int $value): Point
    {
        $that = clone $this;
        $that->y += $value;
        return $that;
    }

    public function subY(int $value): Point
    {
        $that = clone $this;
        $that->y -= $value;
        return $that;
    }

    public function addX(int $value): Point
    {
        $that = clone $this;
        $that->x += $value;
        return $that;
    }

    public function subX(int $value): Point
    {
        $that = clone $this;
        $that->x -= $value;
        return $that;
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