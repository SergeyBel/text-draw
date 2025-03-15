<?php

namespace ConsoleDraw\Figure;

use ConsoleDraw\Plane\Point;
use ConsoleDraw\Plane\Size;

class FrameFigure extends BaseFigure
{
    protected ?Size $size = null;
    protected ?Point $leftUpperCorner = null;

    public function getSize(): ?Size
    {
        return $this->size;
    }

    public function setSize(?Size $size): FrameFigure
    {
        $this->size = $size;
        return $this;
    }

    public function getLeftUpperCorner(): ?Point
    {
        return $this->leftUpperCorner;
    }

    public function setLeftUpperCorner(?Point $leftUpperCorner): FrameFigure
    {
        $this->leftUpperCorner = $leftUpperCorner;
        return $this;
    }



}