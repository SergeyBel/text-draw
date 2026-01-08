<?php

declare(strict_types=1);

namespace TextDraw\Figure\Chart\BarChart;

use TextDraw\Common\Size;

class BarChartData
{
    /**
     * @param array<BarGroup> $groups
     */
    public function __construct(
        private array $groups,
        private Size $size,
    ) {

    }

    /**
     * @return BarGroup[]
     */
    public function getGroups(): array
    {
        return $this->groups;
    }

    public function getSize(): Size
    {
        return $this->size;
    }

}
