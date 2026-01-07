<?php

declare(strict_types=1);

namespace TextDraw\Figure\Geometry\Rectangle;

use TextDraw\Common\Size;
use TextDraw\Plane\Point;

class RectangleData
{
    public function __construct(
        private Point $leftUpperCorner,
        private Size $size,
    ) {
    }

    public function getLeftUpperCorner(): Point
    {
        return $this->leftUpperCorner;
    }

    public function getSize(): Size
    {
        return $this->size;
    }



}
