<?php

declare(strict_types=1);

namespace TextDraw\Figure\Diagrams\BarChart;

class Bar
{
    public function __construct(
        private int $value,
        private string $label
    ) {

    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getLabel(): string
    {
        return $this->label;
    }



}
