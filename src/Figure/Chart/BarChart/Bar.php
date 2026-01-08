<?php

declare(strict_types=1);

namespace TextDraw\Figure\Chart\BarChart;

use TextDraw\Common\Size;

class Bar
{
    public function __construct(
        private int $value,
        private Size $size
    ) {
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function getSize(): Size
    {
        return $this->size;
    }
}
