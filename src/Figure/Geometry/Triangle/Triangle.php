<?php

declare(strict_types=1);

namespace TextDraw\Figure\Geometry\Triangle;

use TextDraw\Figure\Base\FigureDrawerInterface;
use TextDraw\Plane\Point;
use TextDraw\Screen\Screen;

class Triangle implements FigureDrawerInterface
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
    }

    public function draw(): Screen
    {
        return new TriangleDrawer()->draw($this->triangleData, $this->style);
    }

    public function setStyle(TriangleStyle $style): self
    {
        $this->style = $style;
        return $this;
    }
}
