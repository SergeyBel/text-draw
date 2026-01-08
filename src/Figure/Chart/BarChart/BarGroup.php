<?php

declare(strict_types=1);

namespace TextDraw\Figure\Chart\BarChart;

class BarGroup
{
    /**
     * @param array<Bar> $bars
     */
    public function __construct(
        private string $label,
        private array $bars
    ) {
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return Bar[]
     */
    public function getBars(): array
    {
        return $this->bars;
    }

    public function getWidth(): int
    {
        $width = 0;
        foreach ($this->bars as $bar) {
            $width += $bar->getSize()->getWidth();
        }
        return $width;
    }
}
