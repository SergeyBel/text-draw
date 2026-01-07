<?php

declare(strict_types=1);

namespace TextDraw\Figure\Geometry\Triangle;

use TextDraw\Plane\Point;

class TriangleData
{
    public function __construct(
        private Point $vertex1,
        private Point $vertex2,
        private Point $vertex3,
    ) {
    }

    public function getVertex1(): Point
    {
        return $this->vertex1;
    }

    public function getVertex2(): Point
    {
        return $this->vertex2;
    }

    public function getVertex3(): Point
    {
        return $this->vertex3;
    }


}
