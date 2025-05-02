<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Chart\Bar;

class BarChartStyle
{
    private int $barWidth = 2;
    private int $unitHeight = 1;

    public function getBarWidth(): int
    {
        return $this->barWidth;
    }

    public function setBarWidth(int $barWidth): static
    {
        $this->barWidth = $barWidth;
        return $this;
    }

    public function getUnitHeight(): int
    {
        return $this->unitHeight;
    }

    public function setUnitHeight(int $unitHeight): static
    {
        $this->unitHeight = $unitHeight;
        return $this;
    }



}
