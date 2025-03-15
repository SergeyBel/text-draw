<?php

namespace ConsoleDraw\Figure;

use ConsoleDraw\Plane\Point;
use ConsoleDraw\Plane\Size;
use Exception;

class FrameFigure extends BaseFigure
{
    protected ?Size $size = null;
    protected ?Point $leftUpperCorner = null;

    public function getSize(): ?Size
    {
        return $this->size;
    }

    public function setSize(Size $size): FrameFigure
    {
        $this->size = $size;
        return $this;
    }

    public function getLeftUpperCorner(): ?Point
    {
        return $this->leftUpperCorner;
    }

    public function setLeftUpperCorner(Point $leftUpperCorner): FrameFigure
    {
        $this->leftUpperCorner = $leftUpperCorner;
        return $this;
    }

    protected function getDefinedSize(): Size
    {
        if (is_null($this->size)) {
            throw new Exception('Size is null');
        }
        return $this->size;
    }

    protected function getDefinedLeftUpperCorner(): Point
    {
        if (is_null($this->leftUpperCorner)) {
            throw new Exception('LeftUpperCorner is null');
        }
        return $this->leftUpperCorner;
    }
}
