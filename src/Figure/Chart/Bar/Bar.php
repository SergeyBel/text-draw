<?php

declare(strict_types=1);

namespace ConsoleDraw\Figure\Chart\Bar;

class Bar
{
    public function __construct(
        private string $label,
        private int $value
    ) {
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getValue(): int
    {
        return $this->value;
    }


}
