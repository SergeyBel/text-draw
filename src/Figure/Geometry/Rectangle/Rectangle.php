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
        int $x,
        int $y,
        int $width,
        int $height,
    ) {
        $this->rectangleData = new RectangleData(
            new Point($x, $y),
            new Size($width, $height),
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
        $this->style = $style;
        return $this;
    }

}
