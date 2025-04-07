<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure;

use ConsoleDraw\Plane\Point;
use ConsoleDraw\Plane\Size;

class FrameFigure extends BaseFigure
{
    protected Size $size;
    protected Point $leftUpperCorner;

    public function __construct(
        Size $size,
        ?Point $leftUpperCorner = null
    ) {
        $this->size = $size;

        if (!is_null($leftUpperCorner)) {
            $this->leftUpperCorner = $leftUpperCorner;
        } else {
            $this->leftUpperCorner = new Point(0, 0);
        }
    }

    public function getSize(): Size
    {
        return $this->size;
    }

    public function getLeftUpperCorner(): Point
    {
        return $this->leftUpperCorner;
    }

    public function setLeftUpperCorner(Point $leftUpperCorner): FrameFigure
    {
        $this->leftUpperCorner = $leftUpperCorner;
        return $this;
    }
}
