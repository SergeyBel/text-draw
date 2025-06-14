<?php

declare(strict_types=1);

namespace TextDraw\Plane;

use Exception;

class StraightLine
{
    public function __construct(
        private Point $first,
        private Point $second,
    ) {
        if (!$this->isHorizontal() && !$this->isVertical()) {
            throw new Exception('Arrow must be straight');
        }
    }

    public function isHorizontal(): bool
    {
        return $this->first->getY() === $this->second->getY();

    }

    public function isVertical(): bool
    {
        return $this->first->getX() === $this->second->getX();
    }

    public function getFirst(): Point
    {
        return $this->first;
    }

    public function getSecond(): Point
    {
        return $this->second;
    }

    public function getCenter(): Point
    {
        return new Point(
            intdiv($this->first->getX() + $this->second->getX(), 2),
            intdiv($this->first->getY() + $this->second->getY(), 2)
        );
    }


}
