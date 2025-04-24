<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Base;

use ConsoleDraw\Plane\Point;

class PositionFigure extends BaseFigure
{
    protected Point $leftUpperCorner;

    public function __construct(
        ?Point $leftUpperCorner = null
    ) {

        if (!is_null($leftUpperCorner)) {
            $this->leftUpperCorner = $leftUpperCorner;
        } else {
            $this->leftUpperCorner = new Point(0, 0);
        }

        parent::__construct();
    }

    public function getLeftUpperCorner(): Point
    {
        return $this->leftUpperCorner;
    }

}
