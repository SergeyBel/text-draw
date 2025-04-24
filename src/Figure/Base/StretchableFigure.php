<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Base;

use ConsoleDraw\Common\Size;
use ConsoleDraw\Plane\Point;

class StretchableFigure extends PositionFigure
{
    protected Size $size;

    public function __construct(
        Size $size,
        ?Point $leftUpperCorner = null
    ) {
        $this->size = $size;

        parent::__construct($leftUpperCorner);
    }

    public function getSize(): Size
    {
        return $this->size;
    }
}
