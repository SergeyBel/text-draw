<?php

declare(strict_types=1);

namespace TextDraw\Figure\Geometry\Rectangle;

use TextDraw\Common\Size;
use TextDraw\Figure\Base\FigureInterface;
use TextDraw\Plane\Point;
use TextDraw\Screen\Screen;

class Rectangle implements FigureInterface
{
    private RectangleData $rectangleData;
    private RectangleStyle $style;

    public function __construct(
        Point $leftUpperCorner,
        Size $size
    ) {
        $this->rectangleData = new RectangleData(
            $leftUpperCorner,
            $size,
        );

        $this->style = new RectangleStyle();
    }

    public function draw(): Screen
    {
        return new RectangleDrawer()->draw($this->rectangleData, $this->style);
    }

    public function getStyle(): RectangleStyle
    {
        return $this->style;
    }

    public function setStyle(RectangleStyle $style): static
    {
        $that = clone $this;
        $that->style = $style;
        return $that;
    }

}
