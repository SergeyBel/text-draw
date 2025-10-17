<?php

declare(strict_types=1);

namespace TextDraw\Figure\Chart\LineChart;

class LineChartStyle
{
    private int $labelGap = 1;
    public function __construct()
    {

    }

    public function getLabelGap(): int
    {
        return $this->labelGap;
    }

    public function setLabelGap(int $labelGap): self
    {
        $this->labelGap = $labelGap;
        return $this;
    }


}
