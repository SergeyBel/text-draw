<?php

declare(strict_types=1);

namespace TextDraw\Figure\Diagrams\BarChart;

class BarChart
{
    public function __construct(
        private array $bars
    ) {

    }

    public function getBars(): array
    {
        return $this->bars;
    }

}
