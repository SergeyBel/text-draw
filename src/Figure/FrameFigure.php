<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure;

use ConsoleDraw\Common\Size;
use ConsoleDraw\Plane\Point;

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

        parent::__construct();
    }

    public function getSize(): Size
    {
        return $this->size;
    }

    public function getLeftUpperCorner(): Point
    {
        return $this->leftUpperCorner;
    }

    public function setLeftUpperCorner(Point $leftUpperCorner): static
    {
        $this->leftUpperCorner = $leftUpperCorner;
        return $this;
    }
}
