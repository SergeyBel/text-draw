<?php

declare(strict_types=1);

namespace TextDraw\Figure\Geometry\Line;

use TextDraw\Figure\Base\BaseFigure;
use TextDraw\Plane\Point;
use TextDraw\Screen\Screen;

class Line extends BaseFigure
{
    private LineData $lineData;
    private LineStyle $style;

    public function __construct(
        Point $start,
        Point $end,
    ) {
        $this->lineData = new LineData($start, $end);
        $this->style = new LineStyle();
        parent::__construct();
    }

    public function getLineData(): LineData
    {
        return $this->lineData;
    }

    public function draw(): Screen
    {
        return new LineDrawer()->draw(
            $this->lineData,
            $this->style,
        );

    }
    public function getStyle(): ?LineStyle
    {
        return $this->style;
    }

    public function setStyle(LineStyle $style): static
    {
        $that = clone $this;
        $that->style = $style;
        return $that;
    }
}
