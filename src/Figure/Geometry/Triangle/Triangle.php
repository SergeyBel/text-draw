<?php

declare(strict_types=1);

namespace TextDraw\Figure\Geometry\Triangle;

use TextDraw\Figure\Base\BaseFigure;
use TextDraw\Plane\Point;
use TextDraw\Screen\Screen;

class Triangle extends BaseFigure
{
    private TriangleData $triangleData;
    private TriangleStyle $style;

    public function __construct(
        Point $vertex1,
        Point $vertex2,
        Point $vertex3,
    ) {
        $this->triangleData = new TriangleData(
            $vertex1,
            $vertex2,
            $vertex3,
        );
        $this->style = new TriangleStyle();
        parent::__construct();
    }

    public function draw(): Screen
    {
        return new TriangleDrawer()->draw($this->triangleData, $this->style);
    }

    public function setStyle(TriangleStyle $style): self
    {
        $that = clone $this;
        $that->style = $style;
        return $that;
    }
}
