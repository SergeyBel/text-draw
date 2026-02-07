<?php

declare(strict_types=1);

namespace TextDraw\Figure\Geometry\Rectangle;

use TextDraw\Common\Size;
use TextDraw\Plane\Point;

class Rectangle
{
    public function __construct(
        private Point $leftUpperCorner,
        private Size $size
    ) {
    }

    public function getLeftUpperCorner(): Point
    {
        return $this->leftUpperCorner;
    }

    public function getRightUpperCorner(): Point
    {
        return $this->leftUpperCorner->addWidth($this->size->getWidth());
    }
    public function getLeftBottomCorner(): Point
    {
        return $this->leftUpperCorner->addHeight($this->size->getHeight());
    }

    public function getRightBottomCorner(): Point
    {
        return $this->getRightUpperCorner()->addHeight($this->size->getHeight());
    }

    public function getSize(): Size
    {
        return $this->size;
    }
}
