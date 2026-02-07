<?php

declare(strict_types=1);

namespace TextDraw\Figure\Geometry\Line;

use TextDraw\Common\Exception\RenderException;
use TextDraw\Plane\Point;

class Line
{
    public function __construct(
        private Point $start,
        private Point $end,
    ) {
        $this->validate();
    }

    public function getStart(): Point
    {
        return $this->start;
    }

    public function getEnd(): Point
    {
        return $this->end;
    }

    public function isVertical(): bool
    {
        return $this->start->getX() === $this->end->getX();
    }

    public function isHorizontal(): bool
    {
        return $this->start->getY() === $this->end->getY();
    }

    public function isDiagonal(): bool
    {
        return
            abs($this->start->getX() - $this->end->getX()) ===
            abs($this->start->getY() - $this->end->getY());
    }

    public function getMinXPoint(): Point
    {
        return $this->start->getX() <= $this->end->getX() ? $this->start : $this->end;
    }

    public function getMaxXPoint(): Point
    {
        return $this->start->getX() >= $this->end->getX() ? $this->start : $this->end;
    }

    public function getMinYPoint(): Point
    {
        return $this->start->getY() <= $this->end->getY() ? $this->start : $this->end;
    }

    public function getMaxYPoint(): Point
    {
        return $this->start->getY() >= $this->end->getY() ? $this->start : $this->end;
    }

    private function validate(): void
    {
        if (! ($this->isHorizontal() || $this->isVertical() || $this->isDiagonal())) {
            throw new RenderException('Line can be horizontal vertical or diagonal');
        }
    }

}
