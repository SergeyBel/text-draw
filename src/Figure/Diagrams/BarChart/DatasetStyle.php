<?php

declare(strict_types=1);

namespace TextDraw\Figure\Diagrams\BarChart;

use TextDraw\Figure\Geometry\Rectangle\RectangleStyle;

class DatasetStyle
{
    private RectangleStyle $barStyle;


    public function __construct()
    {
        $this->barStyle = new RectangleStyle()->setChar('*');
    }

    public function getBarStyle(): RectangleStyle
    {
        return $this->barStyle;
    }

    public function setBarStyle(RectangleStyle $barStyle): self
    {
        $this->barStyle = $barStyle;
        return $this;
    }
}
