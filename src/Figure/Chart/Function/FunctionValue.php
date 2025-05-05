<?php

declare(strict_types=1);

namespace TextDraw\Figure\Chart\Function;

class FunctionValue
{
    public function __construct(
        private int $x,
        private int $y,
    ) {
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function setX(int $x): static
    {
        $this->x = $x;
        return $this;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function setY(int $y): static
    {
        $this->y = $y;
        return $this;
    }


}
