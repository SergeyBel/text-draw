<?php

declare(strict_types=1);

namespace TextDraw\Figure\Chart\BarChart;

class BarChartStyle
{
    private int $barWidth = 2;
    private int $unitHeight = 1;
    private int $gap = 1;



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


    public function getGap(): int
    {
        return $this->gap;
    }

    public function setGap(int $gap): self
    {
        $this->gap = $gap;
        return $this;
    }




}
